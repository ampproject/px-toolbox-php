<?php

namespace PageExperience\Engine;

use PageExperience\Engine\Dsl\DslJsonFile;
use PageExperience\Engine\Dsl\Operation\RuleCollection;
use PageExperience\Engine\Dsl\Parser;
use PageExperience\Engine\Dsl\ToolSpecific;
use PageExperience\Engine\Exception\InvalidOperation;
use PageExperience\Engine\Exception\NotImplemented;

/**
 * Central rules management for the PX Engine.
 *
 * @package ampproject/px-toolbox
 */
final class Rules
{
    /**
     * Locations for the rules.
     *
     * @var array<string>
     */
    private $locations = [];

    /**
     * Associative array of rule collections.
     *
     * @var array<string, RuleCollection>
     */
    private $rules = [];

    /**
     * Register a location for a rules file.
     *
     * The rules file is a JSON file expressing rules in the PX Engine's own domain=specific language (DSL).
     *
     * @param string $filepathOrUrl Filepath or URL pointing to a rules file.
     * @return void
     */
    public function registerRulesLocation($filepathOrUrl)
    {
        $this->locations[] = $filepathOrUrl;
    }

    /**
     * Read the rules from all the registered rules locations.
     *
     * @return void
     * @throws InvalidOperation When a RuleCollection is expected but a different Operation is returned.
     * @throws NotImplemented If the provided parser type is not supported yet.
     */
    public function readRules()
    {
        foreach ($this->locations as $location) {
            $dslFile = new DslJsonFile($location);
            $parser = $dslFile->getParser();
            if ($parser instanceof Parser\Aggregate) {
                $aggregate = $parser->parse();
                foreach ($aggregate->getSubOperations() as $operation) {
                    if ($operation instanceof RuleCollection) {
                        $this->readToolSpecificRules($operation);
                    }
                }
            } elseif ($parser instanceof ToolSpecific) {
                $ruleCollection = $parser->parse();
                if (! $ruleCollection instanceof RuleCollection) {
                    throw InvalidOperation::whenExpectingRuleCollection($ruleCollection);
                }
                $this->readToolSpecificRules($ruleCollection);
            } else {
                throw NotImplemented::forParserType($parser);
            }
        }
    }

    /**
     * Read tool-specific rules.
     *
     * @param RuleCollection $ruleCollection Rule collection to read.
     * @return void
     */
    private function readToolSpecificRules($ruleCollection)
    {
        $toolName = $ruleCollection->getToolName();
        if (array_key_exists($toolName, $this->rules)) {
            $this->rules[$toolName] = $this->rules[$toolName]->mergeWith($ruleCollection);
        } else {
            $this->rules[$toolName] = $ruleCollection;
        }
    }

    /**
     * Check if rules are known for a specific tool.
     *
     * @param string $toolName Name of the tool to check the rules for.
     * @return bool Whether rules are known for the requested tool.
     */
    public function hasRulesForTool($toolName)
    {
        return array_key_exists($toolName, $this->rules);
    }

    /**
     * Get the rules for a specific tool.
     *
     * @param string $toolName Name of the tool to get the rules for.
     * @return RuleCollection Collection of rules for the requested tool.
     */
    public function getRulesForTool($toolName)
    {
        return $this->rules[$toolName];
    }

    /**
     * Create the default rules instance.
     *
     * @return Rules Rules with package defaults.
     */
    public static function createDefaultRules()
    {
        $rules = new self();
        $rules->registerRulesLocation(__DIR__ . '/../../config/default-dsl.json');
        return $rules;
    }
}
