<?php

namespace PageExperience\Engine;

use PageExperience\Engine\Tool\AnalysisTool;
use PageExperience\Engine\Tool\OptimizationTool;

/**
 * Stack of tools that assembles individual page experience tools.
 *
 * @package ampproject/px-toolbox
 */
interface ToolStack extends AnalysisTool, OptimizationTool
{
}
