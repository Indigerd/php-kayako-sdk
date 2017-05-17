<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\models;

use SimpleXMLElement;

class TicketAttachment extends Model
{
    protected $id;
    protected $ticketId;
    protected $ticketPostId;
    protected $fileName;
    protected $fileSize;
    protected $fileType;
    protected $dateLine;
    protected $contents;

    public static function fromXml(SimpleXMLElement $xml)
    {
        $attachment = new self();
        $attachment->id = (string)$xml->id;
        $attachment->ticketId = (string)$xml->ticketid;
        $attachment->ticketPostId = (string)$xml->ticketpostid;
        $attachment->fileName = (string)$xml->filename;
        $attachment->fileSize = (string)$xml->filesize;
        $attachment->fileType = (string)$xml->filetype;
        $attachment->dateLine = (string)$xml->dateline;
        $attachment->contents = (string)$xml->contents;
        return $attachment;
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
    public function getTicketId()
    {
        return $this->ticketId;
    }

    /**
     * @param mixed $ticketId
     */
    public function setTicketId($ticketId)
    {
        $this->ticketId = $ticketId;
    }

    /**
     * @return mixed
     */
    public function getTicketPostId()
    {
        return $this->ticketPostId;
    }

    /**
     * @param mixed $ticketPostId
     */
    public function setTicketPostId($ticketPostId)
    {
        $this->ticketPostId = $ticketPostId;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return mixed
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * @param mixed $fileSize
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;
    }

    /**
     * @return mixed
     */
    public function getFileType()
    {
        return $this->fileType;
    }

    /**
     * @param mixed $fileType
     */
    public function setFileType($fileType)
    {
        $this->fileType = $fileType;
    }

    /**
     * @return mixed
     */
    public function getDateLine()
    {
        return $this->dateLine;
    }

    /**
     * @param mixed $dateLine
     */
    public function setDateLine($dateLine)
    {
        $this->dateLine = $dateLine;
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
