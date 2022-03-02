<?php

namespace PageExperience\Engine\Dsl;

use PageExperience\Engine\JsonFile;

/**
 * Interface for an expression in a DSL.
 *
 * @package ampproject/px-toolbox
 */
final class DslJsonFile implements Parser
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
     * Parse the DSL(s) into an object hierarchy.
     *
     * @return array<Expression>
     */
    public function parse()
    {
        if (! $this->jsonFile->exists()) {
            // TODO: throw exception.
        }

        $dsl = $this->jsonFile->asArray();

        $parserFactory = new ParserFactory();

        if (array_key_exists('dsls', $dsl)) {
            $parser = $parserFactory->createAggregateParser($dsl['dsls']);
        } else {
            $parser = $parserFactory->createSpecificParser($dsl);
        }

        return $parser->parse();
    }
}
