<?php

namespace PageExperience\Engine\ToolStack;

use AmpProject\RemoteGetRequest;
use AmpProject\RemoteRequest\CurlRemoteGetRequest;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Exception\InvalidTool;
use PageExperience\Engine\Rules;
use PageExperience\Engine\Tool;
use PageExperience\Engine\Tool\AnalysisTool;
use PageExperience\Engine\Tool\Configurable;
use PageExperience\Engine\Tool\Configuration;
use PageExperience\Engine\Tool\DefaultConfiguration;
use PageExperience\Engine\Tool\OptimizationTool;
use PageExperience\Engine\Tool\Programmable;
use PageExperience\Engine\Tool\ToolRuleset;
use PageExperience\Engine\ToolStack;
use ReflectionClass;
use ReflectionException;

/**
 * Factory for assembling a tool stack.
 *
 * @package ampproject/px-toolbox
 */
final class DefaultToolStackFactory implements ToolStackFactory
{
    /**
     * Tool stack configuration to use.
     *
     * @var ToolStackConfiguration
     */
    private $toolStackConfiguration;

    /**
     * Remote request handler instance to use.
     *
     * @var RemoteGetRequest|null
     */
    private $remoteRequest;

    /**
     * Configuration for the engine tools.
     *
     * @var Configuration
     */
    private $configuration;

    /**
     * Instantiate a default tool stack factory object.
     *
     * @param ToolStackConfiguration $toolStackConfiguration Tool stack configuration to use.
     * @param RemoteGetRequest|null  $remoteRequest          Optional. Remote request handler instance to use.
     * @param Configuration|null     $configuration          Optional. Configuration for the engine tools.
     */
    public function __construct(
        ToolStackConfiguration $toolStackConfiguration,
        RemoteGetRequest $remoteRequest = null,
        Configuration $configuration = null
    ) {
        $this->toolStackConfiguration = $toolStackConfiguration;
        $this->remoteRequest          = $remoteRequest;

        $this->configuration
            = $configuration instanceof Configuration
            ? $configuration
            : new DefaultConfiguration();
    }

    /**
     * Create a tool stack instance for analysis.
     *
     * @param Rules                $rules   Rules to use for the programmable tools.
     * @param ConfigurationProfile $profile Configuration profile to use.
     * @return ToolStack Assembled tool stack.
     */
    public function createForAnalysis(Rules $rules, ConfigurationProfile $profile)
    {
        return $this->assembleToolStack(AnalysisTool::class, $rules, $profile);
    }

    /**
     * Create a tool stack instance for optimization.
     *
     * @param Rules                $rules   Rules to use for the programmable tools.
     * @param ConfigurationProfile $profile Configuration profile to use.
     * @return ToolStack Assembled tool stack.
     */
    public function createForOptimization(Rules $rules, ConfigurationProfile $profile)
    {
        return $this->assembleToolStack(OptimizationTool::class, $rules, $profile);
    }

    /**
     * Assemble a tool stack for a given type of tool.
     *
     * @param class-string<Tool>   $toolType Type of tool to assemble the tool stack for.
     * @param Rules                $rules    Rules to use for the programmable tools.
     * @param ConfigurationProfile $profile  Configuration profile to use.
     * @return ToolStack Assembled tool stack.
     */
    private function assembleToolStack($toolType, Rules $rules, ConfigurationProfile $profile)
    {
        $toolClassNames = $this->toolStackConfiguration->getTools();

        $tools = [];
        foreach ($toolClassNames as $toolClassName => $dependencies) {
            if (is_subclass_of($toolClassName, $toolType, true)) {
                $tool     = $this->instantiateTool($toolClassName);
                $toolName = $tool->getName();

                if (! $profile->usesTool($tool->getName())) {
                    continue;
                }

                if ($tool instanceof Programmable && $rules->hasRulesForTool($toolName)) {
                    $tool->attachRuleCollection($rules->getRulesForTool($toolName));
                }

                if ($tool instanceof Configurable) {
                    /** @var class-string<ToolRuleset> $rulesetFqcn */
                    $rulesetFqcn = $tool->getRulesetFqcn();
                    $tool->configureWithRuleset($rulesetFqcn::fromProfile($profile));
                }

                $tools[$toolName] = [$tool, $dependencies];
            }
        }

        // TODO: Parallelize as much as possible.

        return new SequentialToolStack(...array_column($tools, 0));
    }

    /**
     * Instantiate a tool based on its class name.
     *
     * @param class-string<Tool> $toolClassName FQCN of the tool to instantiate.
     * @return Tool Instance of the tool that was requested.
     * @throws InvalidTool If a FQCN was provided that does not implement the Tool interface.
     * @throws InvalidTool If an object was instantiated that does not implement the Tool interface.
     */
    private function instantiateTool($toolClassName)
    {
        if (! is_subclass_of($toolClassName, Tool::class)) {
            throw InvalidTool::forBadFqcn($toolClassName);
        }

        // @TODO: Handle ReflectionException.
        $tool = new $toolClassName(...$this->getToolDependencies($toolClassName));

        if (! $tool instanceof Tool) {
            throw InvalidTool::forBadObject($tool);
        }

        return $tool;
    }

    /**
     * Get the dependencies of a tool and put them in the correct order.
     *
     * @param class-string<Tool> $toolClassName Class of the tool to get the dependencies for.
     * @return array<object|null> Array of dependencies in the order as they appear in the tool's constructor.
     * @throws ReflectionException If the tool could not be reflected upon.
     */
    private function getToolDependencies($toolClassName)
    {
        $constructor = (new ReflectionClass($toolClassName))->getConstructor();

        if ($constructor === null) {
            return [];
        }

        $dependencies = [];
        foreach ($constructor->getParameters() as $parameter) {
            $dependencyType = null;

            // The use of `ReflectionParameter::getClass()` is deprecated in PHP 8, and is superseded
            // by `ReflectionParameter::getType()`. See https://github.com/php/php-src/pull/5209.
            if (PHP_VERSION_ID >= 70100) {
                if ($parameter->getType()) {
                    /** @var \ReflectionNamedType $returnType */
                    $returnType = $parameter->getType();
                    /** @var class-string $fqcn */
                    $fqcn = $returnType->getName();
                    $dependencyType = new ReflectionClass($fqcn);
                }
            } else {
                $dependencyType = $parameter->getClass();
            }

            if ($dependencyType === null) {
                // No type provided, so we pass `null` in the hopes that the argument is optional.
                $dependencies[] = null;
                continue;
            }

            if (is_a($dependencyType->name, RemoteGetRequest::class, true)) {
                if ($this->remoteRequest === null) {
                    $this->remoteRequest = new CurlRemoteGetRequest();
                }
                $dependencies[] = $this->remoteRequest;
                continue;
            }

            if (is_a($dependencyType->name, ToolConfiguration::class, true)) {
                $dependencies[] = $this->configuration->getToolConfiguration($toolClassName);
                continue;
            }

            // Unknown dependency type, so we pass `null` in the hopes that the argument is optional.
            $dependencies[] = null;
        }

        return $dependencies;
    }
}
