<?php

namespace PageExperience\Tests\Engine\Dsl;

use PageExperience\Engine\Dsl\Key;
use PageExperience\Engine\Dsl\Parser;
use PageExperience\Engine\Dsl\ParserFactory;
use PageExperience\Tests\TestCase;

/**
 * Test the ParserFactory class.
 *
 * @package ampproject/px-toolbox-php
 */
final class ParserFactoryTest extends TestCase
{
    /**
     * Test the class instance.
     */
    public function testItCanBeInstantiated()
    {
        $parserFactory = new ParserFactory();

        self::assertInstanceOf(ParserFactory::class, $parserFactory);
    }

    public function testItCanCreateAnAggregateParser()
    {
        $parserFactory = new ParserFactory();

        $aggregateParser = $parserFactory->createAggregateParser([]);

        self::assertInstanceOf(Parser\Aggregate::class, $aggregateParser);
    }

    public function testItCanCreateASpecificParser()
    {
        $parserFactory = new ParserFactory();

        $dsl = [
            Key::ID   => 'some-tool-dsl',
            Key::TYPE => 'tool-dsl',
        ];

        $specificParser = $parserFactory->createSpecificParser($dsl);

        self::assertInstanceOf(Parser\ToolDsl::class, $specificParser);
    }
}
