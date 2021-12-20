<?php

namespace PageExperience\Engine\Analysis\Result;

use PageExperience\Engine\Analysis\Identifiable;
use PageExperience\Engine\Analysis\Result;

/**
 * Result entry of an analysis of type "metric".
 *
 * @package ampproject/px-toolbox
 */
class Metric extends Result implements Identifiable
{
    use HasDescription;
    use HasIdentity;
    use HasLabel;
    use HasAdditionalData;

    /**
     * Value of the metric.
     *
     * @var int|float
     */
    protected $value;

    /**
     * Unit of the metric.
     *
     * @var string
     */
    protected $unit;

    /**
     * Display value of the metric.
     *
     * @var string
     */
    protected $displayValue;

    /**
     * Instantiate a new Metric object.
     *
     * @param string     $id             ID of the metric.
     * @param string     $label          Label of the metric.
     * @param string     $description    Description of the metric.
     * @param int|float  $value          Value of the metric.
     * @param string     $unit           Unit of the metric.
     * @param string     $displayValue   Display value of the metric.
     * @param array|null $additionalData Optional. Additional data of the metric. Null if none.
     */
    public function __construct($id, $label, $description, $value, $unit, $displayValue, $additionalData = null)
    {
        $this->processDescription($description);
        $this->processId($id);
        $this->processLabel($label);
        $this->value        = $value;
        $this->unit         = $unit;
        $this->displayValue = $displayValue;
        $this->processAdditionalData($additionalData);
    }

    /**
     * Get the value of the metric.
     *
     * @return float|int Value of the metric.
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the unit of the metric.
     *
     * @return string Unit of the metric.
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Get the display value of the metric.
     *
     * @return string Display value of the metric.
     */
    public function getDisplayValue()
    {
        return $this->displayValue;
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @return mixed Data which can be serialized by json_encode, which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        $data = [
            'id'           => $this->getId(),
            'label'        => $this->getLabel(),
            'description'  => $this->getDescription(),
            'value'        => $this->getValue(),
            'unit'         => $this->getUnit(),
            'displayValue' => $this->getDisplayValue(),
        ];

        if ($this->hasAdditionalData()) {
            $data['additionalData'] = $this->getAdditionalData();
        }

        return $data;
    }
}
