<?php

namespace PageExperience\Tests;

use PageExperience\Engine;
use PageExperience\Engine\Analysis;
use PageExperience\Engine\ConfigurationProfile;
use Psr\Http\Message\ResponseInterface;

/**
 * Test the Engine entry point class.
 *
 * @package ampproject/px-toolbox-php
 */
final class EngineTest extends TestCase
{

    public function testItCanBeInstantiated()
    {
        $engine = new Engine();

        self::assertInstanceOf(Engine::class, $engine);
    }

    public function testItCanAcceptACustomToolStackFactory()
    {
        $toolStackFactory = $this->createMock(Engine\ToolStack\ToolStackFactory::class);

        $engine = new Engine($toolStackFactory);

        self::assertInstanceOf(Engine::class, $engine);
    }

    public function testItCanAnalyze()
    {
        $engine  = new Engine();
        $profile = new ConfigurationProfile();

        self::assertInstanceOf(Analysis::class, $engine->analyze('https://example.com/', $profile));
    }

    public function testItCanOptimizeHtml()
    {
        $engine  = new Engine();
        $profile = new ConfigurationProfile();

        self::assertStringContainsString('<html>', $engine->optimizeHtml('<html></html>', $profile));
    }

    public function testItCanOptimizeAResponse()
    {
        $engine   = new Engine();
        $profile  = new ConfigurationProfile();
        $response = $this->createMock(ResponseInterface::class);

        self::assertInstanceOf(ResponseInterface::class, $engine->optimizeResponse($response, $profile));
    }
}