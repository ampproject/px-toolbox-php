<?php

namespace PageExperience\Tests\Engine\Tool;

use PageExperience\Engine\Tool\AmpValidator;
use PageExperience\Tests\TestCase;

/**
 * Test the AmpValidator class.
 *
 * @package ampproject/px-toolbox-php
 */
final class AmpValidatorTest extends TestCase
{

    public function testItCanBeInstantiated()
    {
        $ampValidator = new AmpValidator();

        self::assertInstanceOf(AmpValidator::class, $ampValidator);
    }
}
