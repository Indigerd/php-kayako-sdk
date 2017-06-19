<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\models;

use SimpleXMLElement;

class Department extends Model
{
    protected $id;
    protected $title;
    protected $type;
    protected $app;
    protected $displayOrder;
    protected $parentDepartmentId;
    protected $userVisibilityCustom;
    protected $userGroups = [];

    public static function fromXml(SimpleXMLElement $xml)
    {
        $department = new self();
        $department->id = (string)$xml->id;
        $department->title = (string)$xml->title;
        $department->type = (string)$xml->type;
        $department->app = (string)$xml->app;
        $department->displayOrder = (string)$xml->displayorder;
        $department->parentDepartmentId = (string)$xml->parentdepartmentid;
        $department->userVisibilityCustom = (string)$xml->uservisibilitycustom;
        if ($xml->usergroups->count() > 0) {
            foreach ($xml->usergroups->id as $group) {
                $department->addUserGroup((string)$group);
            }
        }
        return $department;
    }

    public function addUserGroup($group)
    {
        $this->userGroups[] = $group;
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getDisplayOrder()
    {
        return $this->displayOrder;
    }

    /**
     * @param mixed $displayOrder
     */
    public function setDisplayOrder($displayOrder)
    {
        $this->displayOrder = $displayOrder;
    }

    /**
     * @return mixed
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param mixed $app
     */
    public function setApp($app)
    {
        $this->app = $app;
    }

    /**
     * @return mixed
     */
    public function getParentDepartmentId()
    {
        return $this->parentDepartmentId;
    }

    /**
     * @param mixed $parentDepartmentId
     */
    public function setParentDepartmentId($parentDepartmentId)
    {
        $this->parentDepartmentId = $parentDepartmentId;
    }

    /**
     * @return mixed
     */
    public function getUserVisibilityCustom()
    {
        return $this->userVisibilityCustom;
    }

    /**
     * @param mixed $userVisibilityCustom
     */
    public function setUserVisibilityCustom($userVisibilityCustom)
    {
        $this->userVisibilityCustom = $userVisibilityCustom;
    }

    /**
     * @return array
     */
    public function getUserGroups()
    {
        return $this->userGroups;
    }

    /**
     * @param array $userGroups
     */
    public function setUserGroups($userGroups)
    {
        $this->userGroups = $userGroups;
    }
}
