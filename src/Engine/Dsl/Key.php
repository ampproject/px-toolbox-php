<?php

namespace PageExperience\Engine\Dsl;

/**
 * Interface for the keys recognized by the domain-specific language (DSL).
 *
 * @package ampproject/px-toolbox
 */
interface Key
{
    /**
     * DSL key for the DSLs entry.
     *
     * @var string
     */
    const DSLS = 'dsls';

    /**
     * DSL key for the ID entry.
     *
     * @var string
     */
    const ID = 'id';

    /**
     * DSL key for the type entry.
     *
     * @var string
     */
    const TYPE = 'type';

    /**
     * DSL key for the tool entry.
     *
     * @var string
     */
    const TOOL = 'tool';

    /**
     * DSL key for the rules entry.
     *
     * @var string
     */
    const RULES = 'rules';

    /**
     * DSL key for the script entry.
     *
     * @var string
     */
    const SCRIPT = 'script';

    /**
     * DSL key for the operation entry.
     *
     * @var string
     */
    const OPERATION = 'operation';
}
