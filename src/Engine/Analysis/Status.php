<?php

namespace PageExperience\Engine\Analysis;

use AmpProject\FakeEnum;

/**
 * Status of an analysis.
 *
 * @method static self UNKNOWN()
 * @method static self SUCCESS()
 * @method static self ERROR()
 *
 * @package ampproject/px-toolbox
 */
final class Status extends FakeEnum
{
    const UNKNOWN = 0;
    const SUCCESS = 1;
    const ERROR   = 2;
}
