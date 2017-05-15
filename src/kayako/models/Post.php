<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\models;

use SimpleXMLElement;

class Post extends Model
{
    protected $id;
    protected $ticketId;
    protected $dateLine;
    protected $userId;
    protected $fullName;
    protected $email;
    protected $ipAddress;
    protected $hasAttachments;
    protected $creator;
    protected $isThirdParty;
    protected $isHtml;
    protected $isEmailed;
    protected $staffId;
    protected $isSurveyComment;
    protected $contents;

    public static function fromXml(SimpleXMLElement $xml)
    {
        $post = new self();
        $post->id = (string)$xml->id;
        $post->ticketId = (string)$xml->ticketid;
        $post->dateLine = (string)$xml->dateLine;
        $post->userId = (string)$xml->userId;
        $post->fullName = (string)$xml->fullName;
        $post->email = (string)$xml->email;
        $post->ipAddress = (string)$xml->ipaddress;
        $post->hasAttachments = (string)$xml->hasattachments;
        $post->creator = (string)$xml->creator;
        $post->isThirdParty = (string)$xml->isthirdparty;
        $post->isHtml = (string)$xml->ishtml;
        $post->isEmailed = (string)$xml->isemailed;
        $post->staffId = (string)$xml->staffid;
        $post->isSurveyComment = (string)$xml->issurveycomment;
        $post->contents = (string)$xml->emailTo;
        return $post;
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
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return mixed
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @param mixed $ipAddress
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
    }

    /**
     * @return mixed
     */
    public function getHasAttachments()
    {
        return $this->hasAttachments;
    }

    /**
     * @param mixed $hasAttachments
     */
    public function setHasAttachments($hasAttachments)
    {
        $this->hasAttachments = $hasAttachments;
    }

    /**
     * @return mixed
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param mixed $creator
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;
    }

    /**
     * @return mixed
     */
    public function getIsHtml()
    {
        return $this->isHtml;
    }

    /**
     * @param mixed $isHtml
     */
    public function setIsHtml($isHtml)
    {
        $this->isHtml = $isHtml;
    }

    /**
     * @return mixed
     */
    public function getIsThirdParty()
    {
        return $this->isThirdParty;
    }

    /**
     * @param mixed $isThirdParty
     */
    public function setIsThirdParty($isThirdParty)
    {
        $this->isThirdParty = $isThirdParty;
    }

    /**
     * @return mixed
     */
    public function getIsEmailed()
    {
        return $this->isEmailed;
    }

    /**
     * @param mixed $isEmailed
     */
    public function setIsEmailed($isEmailed)
    {
        $this->isEmailed = $isEmailed;
    }

    /**
     * @return mixed
     */
    public function getStaffId()
    {
        return $this->staffId;
    }

    /**
     * @param mixed $staffId
     */
    public function setStaffId($staffId)
    {
        $this->staffId = $staffId;
    }

    /**
     * @return mixed
     */
    public function getIsSurveyComment()
    {
        return $this->isSurveyComment;
    }

    /**
     * @param mixed $isSurveyComment
     */
    public function setIsSurveyComment($isSurveyComment)
    {
        $this->isSurveyComment = $isSurveyComment;
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
