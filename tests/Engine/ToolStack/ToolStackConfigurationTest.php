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
    /**
     * Path to the default tool stack JSON configuration file.
     *
     * @var string
     */
    const DEFAULT_TOOLSTACK_JSON_FILEPATH = __DIR__ . '/../../../default-toolstack.json';

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
        self::assertCount(0, $tools);
    }

    public function testItCanReturnToolConfigurationFromJsonFile()
    {
        $toolStackConfiguration = ToolStackConfiguration::fromJsonFile(self::DEFAULT_TOOLSTACK_JSON_FILEPATH);

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
        $toolStackConfiguration = ToolStackConfiguration::fromJsonFile(self::DEFAULT_TOOLSTACK_JSON_FILEPATH);

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
