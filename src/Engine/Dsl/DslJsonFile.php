<?php

namespace PageExperience\Engine\Dsl;

use PageExperience\Engine\JsonFile;

/**
 * Interface for an expression in a DSL.
 *
 * @package ampproject/px-toolbox
 */
final class DslJsonFile
{
    /**
     * JSON file object to use.
     *
     * @var JsonFile
     */
    private $jsonFile;

    /**
     * Instantiate a DslJsonFile object.
     *
     * @param string $filepath Filepath of the JSON file to use.
     */
    public function __construct($filepath)
    {
        $this->jsonFile = new JsonFile($filepath);
    }

    /**
     * Parse the DSL(s) into an operation hierarchy.
     *
     * @return Parser
     */
    public function getParser()
    {
        if (! $this->jsonFile->exists()) {
            // TODO: throw exception.
        }

        $dsl = $this->jsonFile->asArray();

        $parserFactory = new ParserFactory();

        if (array_key_exists(Key::DSLS, $dsl)) {
            return $parserFactory->createAggregateParser($dsl[Key::DSLS]);
        }

        return $parserFactory->createSpecificParser($dsl);
    }
}
