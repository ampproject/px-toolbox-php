<?php

namespace PageExperience\Tests\Engine\Exception;

use RuntimeException;
use PageExperience\Tests\TestCase;
use PageExperience\Engine\Exception\InvalidJsonFile;

/**
 * Test the InvalidJsonFile class.
 *
 * @package ampproject/px-toolbox-php
 */
final class InvalidJsonFileTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $exception = new InvalidJsonFile();

        self::assertInstanceOf(InvalidJsonFile::class, $exception);
    }

    public function testItProducesTheExpectedMessageWithoutPreviousException()
    {
        $exception = InvalidJsonFile::forUnreadableFile('/path/to/file.json');

        self::assertEquals("Could not read JSON file '/path/to/file.json'.", $exception->getMessage());
    }

    public function testItProducesTheExpectedMessageWithPreviousException()
    {
        $previous  = new RuntimeException('PREVIOUS_EXCEPTION');
        $exception = InvalidJsonFile::forUnreadableFile('/path/to/file.json', $previous);

        self::assertEquals(
            "Could not read JSON file '/path/to/file.json'. Reason: PREVIOUS_EXCEPTION",
            $exception->getMessage()
        );
    }

    public function testItProducesTheExpectedMessageForBadlyFormattedFile()
    {
        $exception = InvalidJsonFile::forBadlyFormattedFile('/path/to/file.json', 'invalid_json_data');

        self::assertEquals(
            "JSON file '/path/to/file.json' returned wrong type of data. "
            . "Expected to receive an associative array, got '(string) invalid_json_data' instead.",
            $exception->getMessage()
        );
    }

    public function testItProducesTheExpectedMessageForEmptyFile()
    {
        $exception = InvalidJsonFile::forEmptyFile('/path/to/file.json');

        self::assertEquals(
            "JSON file '/path/to/file.json' returned no data and seems to be empty.",
            $exception->getMessage()
        );
    }

    public function getDataForUndecodableFileTest()
    {
        return [
            'error_constant_JSON_ERROR_DEPTH' => [
                'error'   => JSON_ERROR_DEPTH,
                'message' => "Could not decode JSON file '/path/to/file.json'. Error: JSON_ERROR_DEPTH.",
            ],
            'error_constant_JSON_ERROR_STATE_MISMATCH' => [
                'error'   => JSON_ERROR_STATE_MISMATCH,
                'message' => "Could not decode JSON file '/path/to/file.json'. Error: JSON_ERROR_STATE_MISMATCH.",
            ],
            'error_constant_JSON_ERROR_CTRL_CHAR' => [
                'error'   => JSON_ERROR_CTRL_CHAR,
                'message' => "Could not decode JSON file '/path/to/file.json'. Error: JSON_ERROR_CTRL_CHAR.",
            ],
            'error_constant_JSON_ERROR_SYNTAX' => [
                'error'   => JSON_ERROR_SYNTAX,
                'message' => "Could not decode JSON file '/path/to/file.json'. Error: JSON_ERROR_SYNTAX.",
            ],
            'error_constant_JSON_ERROR_UTF8' => [
                'error'   => JSON_ERROR_UTF8,
                'message' => "Could not decode JSON file '/path/to/file.json'. Error: JSON_ERROR_UTF8.",
            ],
            'error_constant_JSON_ERROR_RECURSION' => [
                'error'   => JSON_ERROR_RECURSION,
                'message' => "Could not decode JSON file '/path/to/file.json'. Error: JSON_ERROR_RECURSION.",
            ],
            'error_constant_JSON_ERROR_INF_OR_NAN' => [
                'error'   => JSON_ERROR_INF_OR_NAN,
                'message' => "Could not decode JSON file '/path/to/file.json'. Error: JSON_ERROR_INF_OR_NAN.",
            ],
            'error_constant_JSON_ERROR_UNSUPPORTED_TYPE' => [
                'error'   => JSON_ERROR_UNSUPPORTED_TYPE,
                'message' => "Could not decode JSON file '/path/to/file.json'. Error: JSON_ERROR_UNSUPPORTED_TYPE.",
            ],
            'error_constant_9' => [
                'error'   => 9,
                'message' => "Could not decode JSON file '/path/to/file.json'. Error: JSON_ERROR_INVALID_PROPERTY_NAME.",
            ],
            'error_constant_10' => [
                'error'   => 10,
                'message' => "Could not decode JSON file '/path/to/file.json'. Error: JSON_ERROR_UTF16.",
            ],
            'error_unknown' => [
                'error'   => 'some_error',
                'message' => "Could not decode JSON file '/path/to/file.json'. Error: <unknown>.",
            ],
        ];
    }

    /**
     * @dataProvider getDataForUndecodableFileTest
     */
    public function testItProducesTheExpectedMessageForUndecodableFile($error, $message)
    {
        $exception = InvalidJsonFile::forUndecodableFile('/path/to/file.json', $error);

        self::assertEquals($message, $exception->getMessage());
    }

    public function testItProducesTheExpectedMessageForMissingFile()
    {
        $exception = InvalidJsonFile::forMissingFile('/path/to/file.json');

        self::assertEquals("Could not find JSON file '/path/to/file.json'.", $exception->getMessage());
    }
}
