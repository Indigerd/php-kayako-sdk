<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\models;

use SimpleXMLElement;

class Ticket extends Model
{
    protected $id;
    protected $departmentId;
    protected $statusId;
    protected $priorityId;
    protected $typeId;
    protected $userId;
    protected $userOrganization;
    protected $userOrganizationId;
    protected $ownerStaffId;
    protected $ownerStaffName;
    protected $fullName;
    protected $email;
    protected $lastReplier;
    protected $subject;
    protected $creationTime;
    protected $lastActivity;
    protected $lastStaffReply;
    protected $lastUserReply;
    protected $slaPlanId;
    protected $nextReplyDue;
    protected $resolutionDue;
    protected $replies;
    protected $ipAddress;
    protected $creator;
    protected $creationMode;
    protected $creationType;
    protected $isEscalated;
    protected $escalationRuleId;
    protected $templateGroupId;
    protected $templateGroupName;
    protected $tags;
    protected $posts = [];

    public static function fromXml(SimpleXMLElement $xml)
    {
        $ticket = new self();
        foreach ($xml->attributes() as $key => $val) {
            if ($key == 'id') {
                $ticket->id = (string)$val;
            }
        }
        $ticket->departmentId = (string)$xml->departmentid;
        $ticket->statusId = (string)$xml->statusid;
        $ticket->priorityId = (string)$xml->priorityid;
        $ticket->typeId = (string)$xml->typeid;
        $ticket->userId = (string)$xml->userid;
        $ticket->userOrganization = (string)$xml->userorganization;
        $ticket->userOrganizationId = (string)$xml->userorganizationid;
        $ticket->ownerStaffId = (string)$xml->ownerstaffid;
        $ticket->ownerStaffName = (string)$xml->ownerstaffname;
        $ticket->fullName = (string)$xml->fullname;
        $ticket->email = (string)$xml->email;
        $ticket->lastReplier = (string)$xml->lastreplier;
        $ticket->subject = (string)$xml->subject;
        $ticket->creationTime = (string)$xml->creationtime;
        $ticket->lastActivity = (string)$xml->lastactivity;
        $ticket->lastStaffReply = (string)$xml->laststaffreply;
        $ticket->lastUserReply = (string)$xml->lastuserreply;
        $ticket->slaPlanId = (string)$xml->slaplanid;
        $ticket->nextReplyDue = (string)$xml->nextreplydue;
        $ticket->resolutionDue = (string)$xml->resolutiondue;
        $ticket->replies = (string)$xml->replies;
        $ticket->ipAddress = (string)$xml->ipaddress;
        $ticket->creator = (string)$xml->creator;
        $ticket->creationMode = (string)$xml->creationmode;
        $ticket->creationType = (string)$xml->creationtype;
        $ticket->isEscalated = (string)$xml->isescalated;
        $ticket->escalationRuleId = (string)$xml->escalationruleid;
        $ticket->templateGroupId = (string)$xml->templategroupid;
        $ticket->templateGroupName = (string)$xml->templategroupname;
        $ticket->tags = (string)$xml->tags;
        $xml->children();
        if ($xml->posts->count() > 0) {
            foreach ($xml->posts->post as $post) {
                $ticket->addPost(Post::fromXml($post));
            }
        }
        return $ticket;
    }

    public function toArray()
    {
        $oldPosts = $this->posts;
        $posts    = [];
        /** @var Post $post */
        foreach ($oldPosts as $post) {
            $posts[] = $post->toArray();
        }
        $this->posts = $posts;
        $result = parent::toArray();
        $this->posts = $oldPosts;
        return $result;
    }

    public function addPost(Post $post)
    {
        $this->posts[] = $post;
    }

    public function getPosts()
    {
        return $this->posts;
    }

    public function setPosts(array $posts = [])
    {
        foreach ($posts as $post) {
            if (! $post instanceof Post) {
                throw new \InvalidArgumentException('Post model expected');
            }
        }
        $this->posts = $posts;
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
    public function getDepartmentId()
    {
        return $this->departmentId;
    }

    /**
     * @param mixed $departmentId
     */
    public function setDepartmentId($departmentId)
    {
        $this->departmentId = $departmentId;
    }

    /**
     * @return mixed
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * @param mixed $statusId
     */
    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;
    }

    /**
     * @return mixed
     */
    public function getPriorityId()
    {
        return $this->priorityId;
    }

    /**
     * @param mixed $priorityId
     */
    public function setPriorityId($priorityId)
    {
        $this->priorityId = $priorityId;
    }

    /**
     * @return mixed
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * @param mixed $typeId
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
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
    public function getUserOrganization()
    {
        return $this->userOrganization;
    }

    /**
     * @param mixed $userOrganization
     */
    public function setUserOrganization($userOrganization)
    {
        $this->userOrganization = $userOrganization;
    }

    /**
     * @return mixed
     */
    public function getUserOrganizationId()
    {
        return $this->userOrganizationId;
    }

    /**
     * @param mixed $userOrganizationId
     */
    public function setUserOrganizationId($userOrganizationId)
    {
        $this->userOrganizationId = $userOrganizationId;
    }

    /**
     * @return mixed
     */
    public function getOwnerStaffId()
    {
        return $this->ownerStaffId;
    }

    /**
     * @param mixed $ownerStaffId
     */
    public function setOwnerStaffId($ownerStaffId)
    {
        $this->ownerStaffId = $ownerStaffId;
    }

    /**
     * @return mixed
     */
    public function getOwnerStaffName()
    {
        return $this->ownerStaffName;
    }

    /**
     * @param mixed $ownerStaffName
     */
    public function setOwnerStaffName($ownerStaffName)
    {
        $this->ownerStaffName = $ownerStaffName;
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
    public function getLastReplier()
    {
        return $this->lastReplier;
    }

    /**
     * @param mixed $lastReplier
     */
    public function setLastReplier($lastReplier)
    {
        $this->lastReplier = $lastReplier;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getCreationTime()
    {
        return $this->creationTime;
    }

    /**
     * @param mixed $creationTime
     */
    public function setCreationTime($creationTime)
    {
        $this->creationTime = $creationTime;
    }

    /**
     * @return mixed
     */
    public function getLastActivity()
    {
        return $this->lastActivity;
    }

    /**
     * @param mixed $lastActivity
     */
    public function setLastActivity($lastActivity)
    {
        $this->lastActivity = $lastActivity;
    }

    /**
     * @return mixed
     */
    public function getLastStaffReply()
    {
        return $this->lastStaffReply;
    }

    /**
     * @param mixed $lastStaffReply
     */
    public function setLastStaffReply($lastStaffReply)
    {
        $this->lastStaffReply = $lastStaffReply;
    }

    /**
     * @return mixed
     */
    public function getLastUserReply()
    {
        return $this->lastUserReply;
    }

    /**
     * @param mixed $lastUserReply
     */
    public function setLastUserReply($lastUserReply)
    {
        $this->lastUserReply = $lastUserReply;
    }

    /**
     * @return mixed
     */
    public function getSlaPlanId()
    {
        return $this->slaPlanId;
    }

    /**
     * @param mixed $slaPlanId
     */
    public function setSlaPlanId($slaPlanId)
    {
        $this->slaPlanId = $slaPlanId;
    }

    /**
     * @return mixed
     */
    public function getNextReplyDue()
    {
        return $this->nextReplyDue;
    }

    /**
     * @param mixed $nextReplyDue
     */
    public function setNextReplyDue($nextReplyDue)
    {
        $this->nextReplyDue = $nextReplyDue;
    }

    /**
     * @return mixed
     */
    public function getResolutionDue()
    {
        return $this->resolutionDue;
    }

    /**
     * @param mixed $resolutionDue
     */
    public function setResolutionDue($resolutionDue)
    {
        $this->resolutionDue = $resolutionDue;
    }

    /**
     * @return mixed
     */
    public function getReplies()
    {
        return $this->replies;
    }

    /**
     * @param mixed $replies
     */
    public function setReplies($replies)
    {
        $this->replies = $replies;
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
    public function getCreationMode()
    {
        return $this->creationMode;
    }

    /**
     * @param mixed $creationMode
     */
    public function setCreationMode($creationMode)
    {
        $this->creationMode = $creationMode;
    }

    /**
     * @return mixed
     */
    public function getCreationType()
    {
        return $this->creationType;
    }

    /**
     * @param mixed $creationType
     */
    public function setCreationType($creationType)
    {
        $this->creationType = $creationType;
    }

    /**
     * @return mixed
     */
    public function getIsEscalated()
    {
        return $this->isEscalated;
    }

    /**
     * @param mixed $isEscalated
     */
    public function setIsEscalated($isEscalated)
    {
        $this->isEscalated = $isEscalated;
    }

    /**
     * @return mixed
     */
    public function getTemplateGroupId()
    {
        return $this->templateGroupId;
    }

    /**
     * @param mixed $templateGroupId
     */
    public function setTemplateGroupId($templateGroupId)
    {
        $this->templateGroupId = $templateGroupId;
    }

    /**
     * @return mixed
     */
    public function getEscalationRuleId()
    {
        return $this->escalationRuleId;
    }

    /**
     * @param mixed $escalationRuleId
     */
    public function setEscalationRuleId($escalationRuleId)
    {
        $this->escalationRuleId = $escalationRuleId;
    }

    /**
     * @return mixed
     */
    public function getTemplateGroupName()
    {
        return $this->templateGroupName;
    }

    /**
     * @param mixed $templateGroupName
     */
    public function setTemplateGroupName($templateGroupName)
    {
        $this->templateGroupName = $templateGroupName;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }
}
