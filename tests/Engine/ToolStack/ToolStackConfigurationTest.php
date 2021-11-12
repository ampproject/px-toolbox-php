<?php

namespace PageExperience\Tests\Engine\ToolStack;

use PageExperience\Engine\Tool\AmpOptimizer;
use PageExperience\Engine\Tool\AmpValidator;
use PageExperience\Engine\Tool\Lighthouse;
use PageExperience\Engine\ToolStack\ToolStackConfiguration;
use PageExperience\Tests\TestCase;

/**
 * Test the ToolStackConfiguration class.
 *
 * @package ampproject/px-toolbox-php
 */
final class ToolStackConfigurationTest extends TestCase
{

    public function testItCanBeInstantiated()
    {
        $toolStackConfiguration = new ToolStackConfiguration();

        self::assertInstanceOf(ToolStackConfiguration::class, $toolStackConfiguration);
    }

    public function testItCanReturnToolConfiguration()
    {
        $toolStackConfiguration = new ToolStackConfiguration();

        $tools = $toolStackConfiguration->getTools();

        self::assertIsArray($tools);
        self::assertCount(3, $tools);
        self::assertArrayHasKey(AmpValidator::class, $tools);
        self::assertEquals([], $tools[AmpValidator::class]);
        self::assertArrayHasKey(AmpOptimizer::class, $tools);
        self::assertEquals([], $tools[AmpOptimizer::class]);
        self::assertArrayHasKey(Lighthouse::class, $tools);
        self::assertEquals([], $tools[Lighthouse::class]);
    }

    public function testItCanRegisterNewTools()
    {
        $toolStackConfiguration = new ToolStackConfiguration();

        $toolStackConfiguration->registerTool('DummyToolA', []);
        $toolStackConfiguration->registerTool('DummyToolB', [AmpValidator::class, 'DummyToolA']);

        $tools = $toolStackConfiguration->getTools();

        self::assertIsArray($tools);
        self::assertCount(5, $tools);
        self::assertArrayHasKey(AmpValidator::class, $tools);
        self::assertEquals([], $tools[AmpValidator::class]);
        self::assertArrayHasKey(AmpOptimizer::class, $tools);
        self::assertEquals([], $tools[AmpOptimizer::class]);
        self::assertArrayHasKey(Lighthouse::class, $tools);
        self::assertEquals([], $tools[Lighthouse::class]);
        self::assertArrayHasKey('DummyToolA', $tools);
        self::assertEquals([], $tools['DummyToolA']);
        self::assertArrayHasKey('DummyToolB', $tools);
        self::assertEquals([AmpValidator::class, 'DummyToolA'], $tools['DummyToolB']);
    }
}
