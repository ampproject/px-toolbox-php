<?php

namespace PageExperience\Engine\Analysis\Result;

use PageExperience\Engine\Analysis\Identifiable;
use PageExperience\Engine\Analysis\Result;

/**
 * Result entry of an analysis of type "issue".
 *
 * @package ampproject/px-toolbox
 */
class Issue extends Result implements Identifiable
{
    use HasDescription;
    use HasIdentity;
    use HasLabel;
    use HasAdditionalData;

    /**
     * Instantiate a new Issue object.
     *
     * @param string                    $id             ID of the issue.
     * @param string                    $label          Label of the issue.
     * @param string                    $description    Description of the issue.
     * @param array<string, mixed>|null $additionalData Optional. Additional data of the issue. Null if none.
     */
    public function __construct($id, $label, $description = '', $additionalData = null)
    {
        $this->processId($id);
        $this->processLabel($label);
        $this->processDescription($description);
        $this->processAdditionalData($additionalData);
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @return mixed Data which can be serialized by json_encode, which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        $data = [
            'id'          => $this->getId(),
            'label'       => $this->getLabel(),
            'description' => $this->getDescription(),
        ];

        if ($this->hasAdditionalData()) {
            $data['additionalData'] = $this->getAdditionalData();
        }

        return $data;
    }
}
