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
     * Instantiate a new Issue object.
     *
     * @param string $id          ID of the issue.
     * @param string $label       Label of the issue.
     * @param string $description Description of the issue.
     */
    public function __construct($id, $label, $description = '')
    {
        $this->id          = $id;
        $this->label       = $label;
        $this->description = $description;
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
     * Specify data which should be serialized to JSON.
     *
     * @return mixed Data which can be serialized by json_encode, which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return [
            'id'          => $this->getId(),
            'label'       => $this->getLabel(),
            'description' => $this->getDescription(),
        ];
    }
}
