<?php

namespace PageExperience\Engine;

use Exception;
use PageExperience\Engine\Exception\InvalidJsonFile;

/**
 * Abstraction for reading and decoding JSON files.
 *
 * @package ampproject/px-toolbox
 */
final class JsonFile
{

    /**
     * Path to the JSON file.
     *
     * @var string
     */
    private $filepath;

    /**
     * Initializes the JSON file instance.
     *
     * @param string $filepath Path to the JSON file.
     */
    public function __construct($filepath)
    {
        $this->filepath = $filepath;
    }

    /**
     * Get the path to the JSON file.
     *
     * @return string Path to the JSON file.
     */
    public function getPath()
    {
        return $this->filepath;
    }

    /**
     * Checks whether the JSON file exists.
     *
     * @return bool Whether the JSON file exists.
     */
    public function exists()
    {
        return is_file($this->filepath);
    }

    /**
     * Return the JSON file contents as an associative array of decoded data.
     *
     * @throws InvalidJsonFile If the file could not be read.
     * @return array<class-string, array<mixed>> Associative array of decoded JSON data.
     */
    public function asArray()
    {
        try {
            $json = file_get_contents($this->filepath);
        } catch (Exception $exception) {
            throw InvalidJsonFile::forUnreadableFile($this->filepath, $exception);
        }

        if ($json === false) {
            throw InvalidJsonFile::forUnreadableFile($this->filepath);
        }

        if (empty($json)) {
            throw InvalidJsonFile::forEmptyFile($this->filepath);
        }

        $data = $this->decodeJson($json);

        if (! is_array($data)) {
            throw InvalidJsonFile::forBadlyFormattedFile($this->filepath, $data);
        }

        return $data;
    }

    /**
     * Decodes JSON string and returns its decoded data.
     *
     * @param string $json JSON string to decode.
     * @return array<class-string, array<mixed>> Decoded JSON data.
     * @throws InvalidJsonFile If the provided JSON data could not be decoded.
     */
    private function decodeJson($json)
    {
        $data = json_decode($json, true);

        if ($data === null) {
            $error = json_last_error();
            if ($error !== JSON_ERROR_NONE) {
                throw InvalidJsonFile::forUndecodableFile($this->filepath, $error);
            }
        }

        return $data;
    }
}
