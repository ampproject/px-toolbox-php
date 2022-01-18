<?php

namespace PageExperience\Tests;

use AmpProject\RemoteGetRequest;
use PageExperience\Engine;
use PageExperience\Engine\Analysis;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\StringStream;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

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

    public function testItCanAcceptACustomRemoteRequestHandler()
    {
        $remoteRequest = $this->createMock(RemoteGetRequest::class);

        $engine = new Engine($remoteRequest);

        self::assertInstanceOf(Engine::class, $engine);
    }

    public function testItCanAcceptACustomToolStackFactory()
    {
        $toolStackFactory = $this->createMock(Engine\ToolStack\ToolStackFactory::class);

        $engine = new Engine(null, $toolStackFactory);

        self::assertInstanceOf(Engine::class, $engine);
    }

    public function testItCanAnalyze()
    {
        $engine  = new Engine(ConfiguredStubbedRemoteGetRequest::create());
        $profile = new ConfigurationProfile();

        self::assertInstanceOf(Analysis::class, $engine->analyze('https://amp-wp.org', $profile));
    }

    public function testItCanOptimizeHtml()
    {
        $engine  = new Engine();
        $profile = new ConfigurationProfile();

        $optimizedHtml = $engine->optimizeHtml('<html></html>', $profile);

        self::assertStringContainsString('<html', $optimizedHtml);
        self::assertStringContainsString('transformed="self;v=1"', $optimizedHtml);
    }

    public function testItCanOptimizeAResponse()
    {
        $engine   = new Engine();
        $profile  = new ConfigurationProfile();
        $response = $this->createMock(ResponseInterface::class);
        $response->method('getBody')
                 ->willReturn(new StringStream('<html></html>'));

        $optimizedResponseCallback = function (...$arguments) {
            $optimizedResponse = $this->createMock(ResponseInterface::class);
            $optimizedResponse->method('getBody')
                              ->willReturn(new StringStream((string) $arguments[0]));
            return $optimizedResponse;
        };

        $response->method('withBody')
                 ->willReturnCallback($optimizedResponseCallback);

        $optimizedResponse = $engine->optimizeResponse($response, $profile);

        self::assertInstanceOf(ResponseInterface::class, $optimizedResponse);
        self::assertInstanceOf(StreamInterface::class, $optimizedResponse->getBody());
        self::assertStringContainsString('<html', (string) $optimizedResponse->getBody());
        self::assertStringContainsString('transformed="self;v=1"', (string) $optimizedResponse->getBody());
    }
}
