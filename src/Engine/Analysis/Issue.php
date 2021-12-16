<?php

namespace PageExperience\Engine\Analysis;

/**
 * Result entry of an analysis of type "issue".
 *
 * @package ampproject/px-toolbox
 */
class Issue extends Result implements Identifiable
{

    /**
     * ID of the issue.
     *
     * @var string
     */
    protected $id;

    /**
     * Label of the issue.
     *
     * @var string
     */
    protected $label;

    /**
     * Description of the issue.
     *
     * @var string
     */
    protected $description;

    /**
     * Display value for the issue.
     *
     * @var string
     */
	protected $displayValue;

    /**
     * Score for the issue.
     *
     * @var string
     */
	protected $score;

    /**
     * Instantiate a new Issue object.
     *
     * @param string $id           ID of the issue.
     * @param string $label        Label of the issue.
     * @param string $description  Description of the issue.
     * @param string $displayValue Display value for the issue.
     * @param string $score        Score for the issue.
     */
    public function __construct($id, $label, $description = '', $displayValue, $score)
    {
        $this->id           = $id;
        $this->label        = $label;
        $this->description  = $description;
        $this->displayValue = $displayValue;
        $this->score        = $score;
    }

    /**
     * Get the ID of the result.
     *
     * @return string ID of the result.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the label for this result.
     *
     * @return string Label for this result.
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Get the description for this result.
     *
     * @return string Description for this result.
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the display value of this result.
     *
     * @return string Display value for this result.
     */
	public function getDisplayValue()
	{
		return $this->displayValue;
	}

    /**
     * Get the score of this result.
     *
     * @return string Score for this result.
     */
	public function getScore()
	{
		return $this->score;
	}

    /**
     * Specify data which should be serialized to JSON.
     *
     * @return mixed Data which can be serialized by json_encode, which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return [
            'id'           => $this->getId(),
            'label'        => $this->getLabel(),
            'description'  => $this->getDescription(),
            'displayValue' => $this->getDisplayValue(),
            'score'        => $this->getScore(),
        ];
    }
}
