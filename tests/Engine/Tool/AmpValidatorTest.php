<?php

namespace PageExperience\Tests\Engine\Tool;

use PageExperience\Engine\Tool\AmpValidator;
use PageExperience\Tests\TestCase;
use Psr\Log\LoggerInterface;

/**
 * Test the AmpValidator class.
 *
 * @package ampproject/px-toolbox-php
 */
final class AmpValidatorTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $loggerMock   = $this->createMock(LoggerInterface::class);
        $ampValidator = new AmpValidator($loggerMock);

        self::assertInstanceOf(AmpValidator::class, $ampValidator);
    }
}
