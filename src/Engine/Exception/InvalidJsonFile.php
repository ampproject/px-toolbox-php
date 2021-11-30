<?php

namespace PageExperience\Engine\Exception;

use Exception;
use InvalidArgumentException;

/**
 * Exception thrown when an invalid JSON file was encountered.
 *
 * @package ampproject/px-toolbox
 */
final class InvalidJsonFile extends InvalidArgumentException implements PxEngineException
{

    /**
     * Instantiate an InvalidJsonFile exception for a JSON file that could not be read.
     *
     * @param string         $filepath Path to the JSON file.
     * @param Exception|null $previous Optional. Previous exception that was thrown. Defaults to null.
     * @return self
     */
    public static function forUnreadableFile($filepath, Exception $previous = null)
    {
        $message = "Could not read JSON file '{$filepath}'.";

        if ($previous instanceof Exception) {
            $message .= " Reason: {$previous->getMessage()}";
        }

        return new self($message, 0, $previous);
    }

    /**
     * Instantiate an InvalidJsonFile exception for a JSON file that returned the wrong type of data.
     *
     * @param string $filepath Path to the JSON file.
     * @param mixed  $data     Data that was returned by the decoding.
     * @return self
     */
    public static function forBadlyFormattedFile($filepath, $data)
    {
        $message = sprintf(
            "JSON file '{$filepath}' returned wrong type of data. "
            . "Expected to receive an associative array, got '%s' instead.",
            new ValueDump($data)
        );

        return new self($message);
    }

    /**
     * Instantiate an InvalidJsonFile exception for a JSON file did not return any data.
     *
     * @param string $filepath Path to the JSON file.
     * @return self
     */
    public static function forEmptyFile($filepath)
    {
        $message = "JSON file '{$filepath}' returned no data and seems to be empty.";

        return new self($message);
    }

    /**
     * Instantiate an InvalidJsonFile exception for JSON data that could not be decoded.
     *
     * @param string $filepath Path to the JSON file.
     * @param int    $error    Error constant that was returned as last error.
     * @return self
     */
    public static function forUndecodableFile($filepath, $error)
    {
        switch ($error) {
            case JSON_ERROR_DEPTH:
                $errorString = 'JSON_ERROR_DEPTH';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $errorString = 'JSON_ERROR_STATE_MISMATCH';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $errorString = 'JSON_ERROR_CTRL_CHAR';
                break;
            case JSON_ERROR_SYNTAX:
                $errorString = 'JSON_ERROR_SYNTAX';
                break;
            case JSON_ERROR_UTF8:
                $errorString = 'JSON_ERROR_UTF8';
                break;
            case JSON_ERROR_RECURSION:
                $errorString = 'JSON_ERROR_RECURSION';
                break;
            case JSON_ERROR_INF_OR_NAN:
                $errorString = 'JSON_ERROR_INF_OR_NAN';
                break;
            case JSON_ERROR_UNSUPPORTED_TYPE:
                $errorString = 'JSON_ERROR_UNSUPPORTED_TYPE';
                break;
            case 9: // Value of the constant JSON_ERROR_INVALID_PROPERTY_NAME (PHP 7.0+).
                $errorString = 'JSON_ERROR_INVALID_PROPERTY_NAME';
                break;
            case 10: // Value of the constant JSON_ERROR_UTF16 (PHP 7.0+).
                $errorString = 'JSON_ERROR_UTF16';
                break;
            default:
                $errorString = '<unknown>';
                break;
        }

        $message = "Could not decode JSON file '{$filepath}'. Error: {$errorString}.";

        return new self($message);
    }

    /**
     * Instantiate an InvalidJsonFile exception for JSON file that was not found.
     *
     * @param string $filepath Path to the JSON file.
     * @return self
     */
    public static function forMissingFile($filepath)
    {
        $message = "Could not find JSON file '{$filepath}'.";

        return new self($message);
    }
}
