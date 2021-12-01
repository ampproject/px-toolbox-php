<?php

namespace PageExperience\Engine;

use Psr\Http\Message\StreamInterface;
use RuntimeException;

/**
 * String-based stream implementation.
 *
 * @package ampproject/px-toolbox
 */
class StringStream implements StreamInterface
{

    /**
     * Contents of the string stream.
     *
     * @var string
     */
    private $contents;

    /**
     * Current offset into the string.
     *
     * @var int
     */
    private $offset = 0;

    /**
     * Instantiate a string-based stream.
     *
     * @param string $contents Contents of the stream.
     */
    public function __construct($contents)
    {
        $this->contents = $contents;
    }

    /**
     * Reads all data from the stream into a string, from the beginning to end.
     *
     * This method MUST attempt to seek to the beginning of the stream before reading data and read the stream until the
     * end is reached.
     *
     * Warning: This could attempt to load a large amount of data into memory.
     *
     * This method MUST NOT raise an exception in order to conform with PHP's string casting operations.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->contents;
    }

    /**
     * Closes the stream and any underlying resources.
     *
     * @return void
     */
    public function close()
    {
        // Nothing to do here.
    }


    /**
     * Separates any underlying resources from the stream.
     *
     * After the stream has been detached, the stream is in an unusable state.
     *
     * @return resource|null Underlying PHP stream, if any.
     */
    public function detach()
    {
        $this->contents = '';

        return null;
    }

    /**
     * Get the size of the stream if known.
     *
     * @return int|null Returns the size in bytes if known, or null if unknown.
     */
    public function getSize()
    {
        return strlen($this->contents);
    }

    /**
     * Returns the current position of the file read/write pointer.
     *
     * @return int Position of the file pointer.
     * @throws RuntimeException If the pointer could not be returned.
     */
    public function tell()
    {
        return $this->offset;
    }

    /**
     * Returns true if the stream is at the end of the stream.
     *
     * @return bool Whether the stream is at its end.
     */
    public function eof()
    {
        return $this->offset === ($this->getSize() - 1);
    }

    /**
     * Returns whether the stream is seekable.
     *
     * @return bool Whether the stream is seekable.
     */
    public function isSeekable()
    {
        return true;
    }

    /**
     * Seek to a position in the stream.
     *
     * @param int $offset Stream offset.
     * @param int $whence Specifies how the cursor position will be calculated based on the seek offset. Valid values
     *                    are identical to the built-in PHP $whence values for `fseek()`:
     *                     - SEEK_SET: Set position equal to offset bytes.
     *                     - SEEK_CUR: Set position to current location plus offset.
     *                     - SEEK_END: Set position to end-of-stream plus offset.
     * @return void
     * @throws RuntimeException If seeking has failed.
     */
    public function seek($offset, $whence = SEEK_SET)
    {
        // TODO: Does $this->offset need to be kept within bounds?

        switch ($whence) {
            case SEEK_SET:
                $this->offset = $offset;
                break;
            case SEEK_CUR:
                $this->offset += $offset;
                break;
            case SEEK_END:
                $this->offset = $this->getSize() - 1 + $offset;
        }
    }

    /**
     * Seek to the beginning of the stream.
     *
     * If the stream is not seekable, this method will raise an exception; otherwise, it will perform a seek(0).
     *
     * @return void
     * @throws RuntimeException If rewinding failed.
     */
    public function rewind()
    {
        $this->offset = 0;
    }

    /**
     * Returns whether the stream is writable.
     *
     * @return bool Whether the stream is writable.
     */
    public function isWritable()
    {
        return false;
    }

    /**
     * Write data to the stream.
     *
     * @param string $string The string that is to be written.
     * @return int Returns the number of bytes written to the stream.
     * @throws RuntimeException If writing into the stream failed.
     */
    public function write($string)
    {
        return 0;
    }

    /**
     * Returns whether the stream is readable.
     *
     * @return bool Whether the stream is readable.
     */
    public function isReadable()
    {
        return true;
    }

    /**
     * Read data from the stream.
     *
     * @param int $length Read up to $length bytes from the object and return them. Fewer than $length bytes may be
     *                    returned if underlying stream call returns fewer bytes.
     * @return string Returns the data read from the stream, or an empty string if no bytes are available.
     * @throws RuntimeException If an error occurs.
     */
    public function read($length)
    {
        // TODO: Does $length need to be kept within bounds?

        return substr($this->contents, $this->offset, $length);
    }

    /**
     * Returns the remaining contents in a string.
     *
     * @return string Remaining portion of the string.
     * @throws RuntimeException If unable to read or an error occurs while reading.
     */
    public function getContents()
    {
        return $this->read($this->getSize() - $this->offset);
    }

    /**
     * Get stream metadata as an associative array or retrieve a specific key.
     *
     * The keys returned are identical to the keys returned from PHP's stream_get_meta_data() function.
     *
     * @param string $key Specific metadata to retrieve.
     * @return array|mixed|null Returns an associative array if no key is provided. Returns a specific key value if a
     *                          key is provided and the value is found, or null if the key is not found.
     */
    public function getMetadata($key = null)
    {
        if ($key === null) {
            return [];
        }

        return null;
    }
}
