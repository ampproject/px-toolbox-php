<?php

namespace PageExperience\Engine\Dsl\Parser;

use PageExperience\Engine\Dsl\Key;
use PageExperience\Engine\Dsl\Operation;
use PageExperience\Engine\Dsl\Parser;
use PageExperience\Engine\Dsl\ToolSpecific;
use PageExperience\Engine\Exception\NotImplemented;

/**
 * Parser for a tool-specific DSL.
 *
 * @package ampproject/px-toolbox
 */
final class ToolDsl implements Parser, ToolSpecific
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
      * Get the ID of this DSL.
      *
      * @return string ID of the DSL.
      */
    public function getId()
    {
        if (! array_key_exists(Key::ID, $this->dsl)) {
            // TODO: Throw exception.
        }

        return $this->dsl[Key::ID];
    }

    /**
     * Get the name of the tool that this DSL is for.
     *
     * @return string Name of the tool that this DSL is for.
     */
    public function getToolName()
    {
        if (! array_key_exists(Key::TOOL, $this->dsl)) {
            // TODO: Throw exception.
        }

        return $this->dsl[Key::TOOL];
    }

    /**
     * Parse the DSL(s) into an object hierarchy.
     *
     * @return Operation\RuleCollection
     */
    public function parse()
    {
        // TODO: Check version of $this->dsl.

        $rules = [];

        if (! array_key_exists(Key::RULES, $this->dsl)) {
            // TODO: Throw exception.
        }

        foreach ($this->dsl[Key::RULES] as $dslEntry) {
            if (! array_key_exists(Key::ID, $dslEntry)) {
                // TODO: Throw exception.
            }

            $rules[(string)$dslEntry[Key::ID]] = $this->parseDslEntry($dslEntry);
        }

        return new Operation\RuleCollection($this->dsl[Key::TOOL], $rules);
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
        if (! array_key_exists(Key::SCRIPT, $dslEntry)) {
            // TODO: Throw exception.
        }

        $operations = [];

        foreach ($dslEntry[Key::SCRIPT] as $scriptEntry) {
            if (! array_key_exists(Key::OPERATION, $scriptEntry)) {
                // TODO: Throw exception.
            }

            switch ($scriptEntry[Key::OPERATION]) {
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
                    throw NotImplemented::forDslOperation($scriptEntry[Key::OPERATION]);
            }
        }

        return new Operation\Aggregate($operations);
    }
}
