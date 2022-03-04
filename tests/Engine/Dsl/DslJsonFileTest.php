<?php

namespace PageExperience\Tests\Engine\Dsl;

use PageExperience\Engine\Dsl\DslJsonFile;
use PageExperience\Engine\Dsl\Operation;
use PageExperience\Engine\Exception\InvalidJsonFile;
use PageExperience\Tests\TestCase;

/**
 * Test the DslJsonFile class.
 *
 * @package ampproject/px-toolbox-php
 */
final class DslJsonFileTest extends TestCase
{
    /**
     * Test the class instance.
     */
    public function testItCanBeInstantiated()
    {
        $dslJsonFile = new DslJsonFile('dsl.json');

        self::assertInstanceOf(DslJsonFile::class, $dslJsonFile);
    }

    public function testItThrowsAnExceptionIfTheJsonFileDoesNotExist()
    {
        $dslJsonFile = new DslJsonFile('some-json-file.json');

        self::expectException(InvalidJsonFile::class);

        $dslJsonFile->parse();
    }

    public function testItCanParseADslFile()
    {
        $dslJsonFile = new DslJsonFile(__DIR__ . '/../../fixtures/dsl/dsl.json');

        $operation = $dslJsonFile->parse();
        self::assertInstanceOf(Operation::class, $operation);
        self::assertInstanceOf(Operation\Aggregate::class, $operation);
    }
}
