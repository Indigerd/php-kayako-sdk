<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\models;

use SimpleXMLElement;

class UserGroup extends Model
{
    protected $id;
    protected $title;
    protected $groupType;
    protected $isMaster;

    public static function fromXml(SimpleXMLElement $xml)
    {
        $userGroup = new self();
        $userGroup->id = (string)$xml->id;
        $userGroup->title = (string)$xml->title;
        $userGroup->groupType = (string)$xml->grouptype;
        $userGroup->isMaster = (string)$xml->ismaster;
        return $userGroup;
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
    public function getGroupType()
    {
        return $this->groupType;
    }

    /**
     * @param mixed $groupType
     */
    public function setGroupType($groupType)
    {
        $this->groupType = $groupType;
    }

    /**
     * @return mixed
     */
    public function getIsMaster()
    {
        return $this->isMaster;
    }

    /**
     * @param mixed $isMaster
     */
    public function setIsMaster($isMaster)
    {
        $this->isMaster = $isMaster;
    }
}
