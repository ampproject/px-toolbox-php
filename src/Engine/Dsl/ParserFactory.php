<?php

namespace PageExperience\Engine\Dsl;

/**
 * Factory for instantiating specific parsers.
 *
 * @package ampproject/px-toolbox
 */
final class ParserFactory
{
    /**
     * Create an aggregate parser that parses multiple DSLs contained in one file.
     *
     * @param array<string, mixed> $dsls DSLs to pass to the parser.
     * @return Parser\Aggregate Aggregate parser to use for parsing the DSLs.
     */
    public function createAggregateParser(array $dsls)
    {
        return new Parser\Aggregate($dsls);
    }

    /**
     * Create a specific parser for a specific DSL.
     *
     * @param array<string, mixed> $dsl DSL to pass to the parser.
     * @return Parser Specific parser to use for parsing the DSL.
     */
    public function createSpecificParser(array $dsl)
    {
        if (! array_key_exists(Key::TYPE, $dsl)) {
            // TODO: throw exception.
        }

        /** @var class-string<Parser> $class */
        $class = __NAMESPACE__ . '\\Parser\\' . $this->sanitizeAsClassName($dsl[Key::TYPE]);

        if (! class_exists($class)) {
            // TODO: throw exception.
        }

        return new $class($dsl);
    }

    /**
     * Sanitize a parser type as a valid class name.
     *
     * @param string $type Parser type to sanitize.
     * @return string Sanitized class name (without the namespace).
     */
    private function sanitizeAsClassName($type)
    {
        $words            = explode('-', $type);
        $capitalizedWords = array_map('ucfirst', $words);
        $class            = implode('', $capitalizedWords);

        return $class;
    }
}
