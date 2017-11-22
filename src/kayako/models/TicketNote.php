<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\models;

use SimpleXMLElement;

class TicketNote extends Model
{
    protected $type;
    protected $id;
    protected $ticketId;
    protected $noteColor;
    protected $creatorStaffId;
    protected $forStaffId;
    protected $creatorStaffName;
    protected $creationDate;
    protected $contents;

    public static function fromXml(SimpleXMLElement $xml)
    {
        $note = new self();
        $mapping = [
            'type'  => 'type',
            'id'    => 'id',
            'ticketid'    => 'ticketId',
            'notecolor'    => 'noteColor',
            'creatorstaffid'    => 'creatorStaffId',
            'forstaffid'    => 'forStaffId',
            'creatorstaffname'    => 'creatorStaffName',
            'creationdate'    => 'creationDate'
        ];
        foreach ($xml->attributes() as $key => $val) {
            if (isset($mapping[$key])) {
                $note->{$mapping[$key]} = (string)$val;
            }
        }
        $note->contents = (string)$xml;
        return $note;
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
    public function getNoteColor()
    {
        return $this->noteColor;
    }

    /**
     * @param mixed $noteColor
     */
    public function setNoteColor($noteColor)
    {
        $this->noteColor = $noteColor;
    }

    /**
     * @return mixed
     */
    public function getCreatorStaffId()
    {
        return $this->creatorStaffId;
    }

    /**
     * @param mixed $creatorStaffID
     */
    public function setCreatorStaffId($creatorStaffID)
    {
        $this->creatorStaffId = $creatorStaffID;
    }

    /**
     * @return mixed
     */
    public function getForStaffId()
    {
        return $this->forStaffId;
    }

    /**
     * @param mixed $forStaffId
     */
    public function setForStaffId($forStaffId)
    {
        $this->forStaffId = $forStaffId;
    }

    /**
     * @return mixed
     */
    public function getCreatorStaffName()
    {
        return $this->creatorStaffName;
    }

    /**
     * @param mixed $creatorStaffName
     */
    public function setCreatorStaffName($creatorStaffName)
    {
        $this->creatorStaffName = $creatorStaffName;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return mixed
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * @param mixed $contents
     */
    public function setContents($contents)
    {
        $this->contents = $contents;
    }
}
