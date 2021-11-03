<?php

namespace PageExperience\Engine\Tool\Lighthouse;

use AmpProject\FakeEnum;

/**
 * Strategy to use for the Lighthouse audit.
 *
 * @method static self MOBILE()
 * @method static self DESKTOP()
 *
 * @extends FakeEnum<string>
 *
 * @package ampproject/px-toolbox
 */
final class Strategy extends FakeEnum
{
    const MOBILE  = 'mobile';
    const DESKTOP = 'desktop';
}
