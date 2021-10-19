<?php

namespace PageExperience\Engine\Analysis;

use AmpProject\FakeEnum;

/**
 * Scope of an analysis.
 *
 * @method static self UNKNOWN()
 * @method static self SITE()
 * @method static self PAGE()
 * @method static self FRAGMENT()
 *
 * @package ampproject/px-toolbox
 */
final class Scope extends FakeEnum
{

    const UNKNOWN  = 0;
    const SITE     = 1;
    const PAGE     = 2;
    const FRAGMENT = 3;
}
