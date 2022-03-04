<?php

namespace PageExperience\Engine\Dsl\Parser;

use PageExperience\Engine\Dsl\Operation;
use PageExperience\Engine\Dsl\Parser;
use PageExperience\Engine\Exception\NotImplemented;

/**
 * Parser for a tool-specific DSL.
 *
 * @package ampproject/px-toolbox
 */
final class ToolDsl implements Parser
{
    /**
     * DSL to parse.
     *
     * @var array<string, mixed>
     */
    private $dsl;

    /**
     * Instantiate a ToolDsl specific parser object.
     *
     * @param array<string, mixed> $dsl DSL to parse.
     */
    public function __construct(array $dsl)
    {
        $this->dsl = $dsl;
    }

    /**
     * Parse the DSL(s) into an object hierarchy.
     *
     * @return Operation
     */
    public function parse()
    {
        // TODO: Check version of $this->dsl.

        $rules = [];

        if (! array_key_exists('rules', $this->dsl)) {
            // TODO: Throw exception.
        }

        foreach ($this->dsl['rules'] as $dslEntry) {
            if (! array_key_exists('id', $dslEntry)) {
                // TODO: Throw exception.
            }

            $rules[(string)$dslEntry['id']] = $this->parseDslEntry($dslEntry);
        }

        return new Operation\RuleCollection($rules);
    }

    /**
     * Parse a single DSL entry into an operation object.
     *
     * @param array<string, mixed> $dslEntry DSL entry to parse into an operation.
     * @return Operation
     * @throws NotImplemented If an operation is encountered that hasn't been implemented (yet).
     */
    private function parseDslEntry($dslEntry)
    {
        if (! array_key_exists('script', $dslEntry)) {
            // TODO: Throw exception.
        }

        $operations = [];

        foreach ($dslEntry['script'] as $scriptEntry) {
            if (! array_key_exists('operation', $scriptEntry)) {
                // TODO: Throw exception.
            }

            switch ($scriptEntry['operation']) {
                case Operation\Extract::ID:
                    if (! array_key_exists(Operation\Extract::ARG_KEYCHAIN, $scriptEntry)) {
                        // TODO: Throw exception.
                    }

                    $operations[] = new Operation\Extract($scriptEntry[Operation\Extract::ARG_KEYCHAIN]);
                    break;

                case Operation\Forward::ID:
                    if (! array_key_exists(Operation\Forward::ARG_KEYS, $scriptEntry)) {
                        // TODO: Throw exception.
                    }

                    $operations[] = new Operation\Forward($scriptEntry[Operation\Forward::ARG_KEYS]);
                    break;

                default:
                    throw NotImplemented::forDslOperation($scriptEntry['operation']);
            }
        }

        return new Operation\Aggregate($operations);
    }
}
