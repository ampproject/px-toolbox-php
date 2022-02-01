<?php

namespace PageExperience\Engine\Analysis\Result;

/**
 * Result entry of an analysis of type "scored metric".
 *
 * @package ampproject/px-toolbox
 */
class ScoredMetric extends Metric
{
    /**
     * Normalized score.
     *
     * Normalization turns all scores into a value on the range of 0..1.
     *
     * @var float
     */
    protected $score;

    /**
     * Type of score.
     *
     * @var string
     */
    protected $scoreType;

    /**
     * Instantiate a new Metric object.
     *
     * @param string                    $id             ID of the metric.
     * @param string                    $label          Label of the metric.
     * @param string                    $description    Description of the metric.
     * @param int|float                 $value          Value of the metric.
     * @param string                    $unit           Unit of the metric.
     * @param string                    $displayValue   Display value of the metric.
     * @param float                     $score          Score of the metric.
     * @param string                    $scoreType      Type of score of the metric.
     * @param array<string, mixed>|null $additionalData Optional. Additional data of the metric. Null if none.
     */
    public function __construct(
        $id,
        $label,
        $description,
        $value,
        $unit,
        $displayValue,
        $score,
        $scoreType,
        $additionalData = null
    ) {
        parent::__construct($id, $label, $description, $value, $unit, $displayValue, $additionalData);

        $this->score     = $score;
        $this->scoreType = $scoreType;
    }

    /**
     * Get the score of the metric.
     *
     * @return float Score of the metric.
     */
    public function getScore()
    {
        return $this->score;
    }


    /**
     * Get the score type of the metric.
     *
     * @return string Score type of the metric.
     */
    public function getScoreType()
    {
        return $this->scoreType;
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @return mixed Data which can be serialized by json_encode, which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [
            'score'     => $this->getScore(),
            'scoreType' => $this->getScoreType(),
        ]);
    }
}
