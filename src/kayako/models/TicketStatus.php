<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\models;

use SimpleXMLElement;

class TicketStatus extends Model
{
    protected $id;
    protected $title;
    protected $displayOrder;
    protected $displayIcon;
    protected $type;
    protected $displayInMainList;
    protected $markAsResolved;

    public static function fromXml(SimpleXMLElement $xml)
    {
        $status = new self();
        $status->id = (string)$xml->id;
        $status->title = (string)$xml->title;
        $status->displayOrder = (string)$xml->displayorder;
        $status->displayIcon = (string)$xml->displayicon;
        $status->type = (string)$xml->type;
        $status->displayInMainList = (string)$xml->displayinmainlist;
        $status->markAsResolved = (string)$xml->markasresolved;
        return $status;
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
    public function getDisplayIcon()
    {
        return $this->displayIcon;
    }

    /**
     * @param mixed $displayIcon
     */
    public function setDisplayIcon($displayIcon)
    {
        $this->displayIcon = $displayIcon;
    }

    /**
     * @return mixed
     */
    public function getDisplayInMainList()
    {
        return $this->displayInMainList;
    }

    /**
     * @param mixed $displayInMainList
     */
    public function setDisplayInMainList($displayInMainList)
    {
        $this->displayInMainList = $displayInMainList;
    }

    /**
     * @return mixed
     */
    public function getMarkAsResolved()
    {
        return $this->markAsResolved;
    }

    /**
     * @param mixed $markAsResolved
     */
    public function setMarkAsResolved($markAsResolved)
    {
        $this->markAsResolved = $markAsResolved;
    }
}
