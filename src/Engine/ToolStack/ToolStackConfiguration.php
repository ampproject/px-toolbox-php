<?php

namespace PageExperience\Engine\ToolStack;

use PageExperience\Engine\Exception\InvalidJsonFile;
use PageExperience\Engine\Exception\InvalidToolStackConfiguration;
use PageExperience\Engine\JsonFile;
use PageExperience\Engine\Tool;

/**
 * Configuration for assembling a tool stack.
 *
 * @package ampproject/px-toolbox
 */
final class ToolStackConfiguration
{

    /**
     * List of tools and their dependencies.
     *
     * @var array<class-string<Tool>, array<class-string<Tool>>> Associative array of tools. Key is the tool FQCN,
     *                                                           value is an array of dependencies.
     */
    private $tools = [];

    /**
     * Instantiate a new ToolStackConfiguration object from an array of configuration data.
     *
     * @param array<class-string<Tool>, array<mixed>> $data Array of configuration data.
     * @return ToolStackConfiguration
     */
    public static function fromArray(array $data)
    {
        $data = self::validate($data);

        $toolStackConfiguration = new self();
        $toolStackConfiguration->tools = $data;

        return $toolStackConfiguration;
    }

    /**
     * Instantiate a new ToolStackConfiguration object from a JSON file.
     *
     * @param string $jsonFilePath Path to the JSON file.
     * @return ToolStackConfiguration
     * @throws InvalidJsonFile If the provided file path does not exist.
     */
    public static function fromJsonFile($jsonFilePath)
    {
        $jsonFile = new JsonFile($jsonFilePath);

        if (! $jsonFile->exists()) {
            throw InvalidJsonFile::forMissingFile($jsonFilePath);
        }

        /** @var array<class-string<Tool>, array<mixed>> $data */
        $data = $jsonFile->asArray();

        return self::fromArray($data);
    }

    /**
     * Get the registered tools and their inter-dependencies.
     *
     * @return array<class-string<Tool>, array<class-string<Tool>>> Associative array of tools. Key is the tool FQCN,
     *                                                              value is an array of dependencies.
     */
    public function getTools()
    {
        // TODO: Use dynamic configuration data.

        // TODO: Dispatch event to allow for last-minute dynamic changes.

        return $this->tools;
    }

    /**
     * Register a new tool with the tool stack configuration.
     *
     * @param class-string<Tool>        $toolFqcn         Fully-qualified class name of the tool implementation.
     * @param array<class-string<Tool>> $toolDependencies Array of fully-qualified class names of the tool dependencies.
     * @return void
     */
    public function registerTool($toolFqcn, $toolDependencies)
    {
        $this->tools[$toolFqcn] = $toolDependencies;
    }

    /**
     * Validate the data that was passed in as configuration.
     *
     * @param mixed $data Data to validate.
     * @throws InvalidToolStackConfiguration If the tool stack configuration could not be validated.
     * @return array<class-string<Tool>, array<mixed>> Validated data.
     */
    private static function validate($data)
    {
        // TODO: Validate the data.

        return $data;
    }
}
