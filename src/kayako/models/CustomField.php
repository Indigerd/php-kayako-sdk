<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\models;

use SimpleXMLElement;

class CustomField extends Model
{
    protected $id;
    protected $groupId;
    protected $title;
    protected $fieldType;
    protected $fieldName;
    protected $defaultValue;
    protected $isRequired;
    protected $userEditable;
    protected $description;

    public static function fromXml(SimpleXMLElement $xml)
    {
        $field = new self();
        $mapping = [
            'customfieldid'      => 'id',
            'customfieldgroupid' => 'groupId',
            'title'              => 'title',
            'fieldtype'          => 'fieldType',
            'fieldname'          => 'fieldName',
            'defaultvalue'       => 'defaultValue',
            'isrequired'         => 'isRequired',
            'usereditable'       => 'userEditable',
            'description'        => 'description',
        ];
        foreach ($xml->attributes() as $key => $val) {
            if (isset($mapping[$key])) {
                $field->{$mapping[$key]} = (string)$val;
            }
        }
        return $field;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param mixed $groupId
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getFieldType()
    {
        return $this->fieldType;
    }

    /**
     * @param mixed $fieldType
     */
    public function setFieldType($fieldType)
    {
        $this->fieldType = $fieldType;
    }

    /**
     * @return mixed
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * @param mixed $fieldName
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;
    }

    /**
     * @return mixed
     */
    public function getIsRequired()
    {
        return $this->isRequired;
    }

    /**
     * @param mixed $isRequired
     */
    public function setIsRequired($isRequired)
    {
        $this->isRequired = $isRequired;
    }

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @param mixed $defaultValue
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
    }

    /**
     * @return mixed
     */
    public function getUserEditable()
    {
        return $this->userEditable;
    }

    /**
     * @param mixed $userEditable
     */
    public function setUserEditable($userEditable)
    {
        $this->userEditable = $userEditable;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}
