<?php

namespace PageExperience\Engine\Tool\Lighthouse;

use Exception;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Exception\FailedToConfigureTool;
use PageExperience\Engine\Exception\ToolRulesetMismatch;
use PageExperience\Engine\Tool;
use PageExperience\Engine\Tool\Lighthouse;
use PageExperience\Engine\Tool\ToolRuleset;

/**
 * Ruleset for the Lighthouse tool.
 *
 * @package ampproject/px-toolbox
 */
final class Ruleset implements ToolRuleset
{
    /**
     * Instantiate a new ruleset from a configuration profile.
     *
     * @param ConfigurationProfile $profile Configuration profile to instantiate a ruleset from.
     * @return ToolRuleset Ruleset instance.
     */
    public static function fromProfile(ConfigurationProfile $profile)
    {
        // TODO: Instantiate out of real configuration data.

        return new self();
    }

    /**
     * Get the name of the tool.
     *
     * @return string Name of the tool.
     */
    public function getToolName()
    {
        return Lighthouse::NAME;
    }

    /**
     * Configure the tool based on this ruleset.
     *
     * @param Tool $tool Tool to configure with this ruleset.
     * @return void
     *
     * @throws ToolRulesetMismatch   If the ruleset did not match the provided tool.
     * @throws FailedToConfigureTool If the configuration of the tool failed.
     */
    public function configureTool(Tool $tool)
    {
        if (! $tool instanceof Lighthouse) {
            throw ToolRulesetMismatch::forToolWithToolRuleset($tool, $this);
        }

        try {
            $tool->configureWithRuleset($this);
        } catch (Exception $exception) {
            throw FailedToConfigureTool::forTool($tool->getName(), $exception);
        }
    }

    /**
     * Get the PageSpeed Insights API key to use.
     *
     * @return string PageSpeed Insights API key.
     */
    public function getPsiApiKey()
    {
        // TODO: Use actual configuration.

        return '123';
    }

    /**
     * Get the Lighthouse strategy to use.
     *
     * @return Strategy Lighthouse strategy to use.
     */
    public function getStrategy()
    {
        // TODO: Use actual configuration.

        return Strategy::MOBILE();
    }

    /**
     * Get the referrer to use.
     *
     * @return string Referrer to use.
     */
    public function getReferrer()
    {
        // TODO: Use actual configuration.

        return 'https://example.com/';
    }
}
