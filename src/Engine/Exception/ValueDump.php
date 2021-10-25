<?php

namespace PageExperience\Engine\Exception;

/**
 * Helper class used to dump value as a string.
 *
 * @package ampproject/px-toolbox
 */
final class ValueDump
{

    /**
     * Value to dump.
     *
     * @var mixed
     */
    private $value;

    /**
     * Instantiate a ValueDump object.
     *
     * @param mixed $value Value to dump.
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Return a string representation of the ValueDump object.
     *
     * @return string String representation of the ValueDump object.
     */
    public function __toString()
    {
        if (is_object($this->value)) {
            return '(object) ' . get_class($this->value);
        }

        if (is_array($this->value)) {
            return sprintf('array(%d)', count($this->value));
        }

        if (is_resource($this->value)) {
            return gettype($this->value);
        }

        return $this->dumpScalarValue();
    }

    /**
     * Dump a scalar value.
     *
     * @return string Scalar value string representation.
     */
    private function dumpScalarValue()
    {
        $type = gettype($this->value);

        switch ($type) {
            case 'boolean':
                return $this->value ? '(bool) true' : '(bool) false';
            case 'integer':
                return "(int) {$this->value}";
            case 'double':
                return "(float) {$this->value}";
            case 'NULL':
                return 'null';
            case 'unknown type':
                return 'unknown';
            default:
                return "({$type}) {$this->value}";
        }
    }
}
