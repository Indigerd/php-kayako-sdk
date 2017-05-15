<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\models;

use SimpleXMLElement;

class User extends Model
{
    protected $id;
    protected $userGroupId;
    protected $userRole;
    protected $userOrganizationId;
    protected $salutation;
    protected $userExpiry;
    protected $fullName;
    protected $designation;
    protected $phone;
    protected $dateLine;
    protected $lastVisit;
    protected $isEnabled;
    protected $timeZone;
    protected $enabledSt;
    protected $slaPlanId;
    protected $slaPlanExpiry;
    protected $email = [];

    public static function fromXml(SimpleXMLElement $xml)
    {
        $user = new self();
        $user->id = (string)$xml->id;
        $user->userGroupId = (string)$xml->usergroupid;
        $user->userRole = (string)$xml->userrole;
        $user->userOrganizationId = (string)$xml->userorganizationid;
        $user->salutation = (string)$xml->salutation;
        $user->userExpiry = (string)$xml->userexpiry;
        $user->fullName = (string)$xml->fullname;
        $user->designation = (string)$xml->designation;
        $user->phone = (string)$xml->phone;
        $user->dateLine = (string)$xml->dateline;
        $user->lastVisit = (string)$xml->lastvisit;
        $user->isEnabled = (string)$xml->isenabled;
        $user->timeZone = (string)$xml->timezone;
        $user->enabledSt = (string)$xml->enabledst;
        $user->slaPlanId = (string)$xml->slaplanid;
        $user->slaPlanExpiry = (string)$xml->slaplanexpiry;
        foreach ($xml->children() as $child) {
            /** @var SimpleXMLElement $child */
            if ($child->getName() == 'email') {
                $user->addEmail((string)$child);
            }
        }
        return $user;
    }

    protected function addEmail($email)
    {
        $this->email[] = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUserGroupId()
    {
        return $this->userGroupId;
    }

    /**
     * @return string
     */
    public function getUserRole()
    {
        return $this->userRole;
    }

    /**
     * @return string
     */
    public function getUserOrganizationId()
    {
        return $this->userOrganizationId;
    }

    /**
     * @return string
     */
    public function getUserExpiry()
    {
        return $this->userExpiry;
    }

    /**
     * @return string
     */
    public function getSalutation()
    {
        return $this->salutation;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getDateLine()
    {
        return $this->dateLine;
    }

    /**
     * @return string
     */
    public function getLastVisit()
    {
        return $this->lastVisit;
    }

    /**
     * @return string
     */
    public function getIsEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * @return string
     */
    public function getTimeZone()
    {
        return $this->timeZone;
    }

    /**
     * @return string
     */
    public function getEnabledSt()
    {
        return $this->enabledSt;
    }

    /**
     * @return string
     */
    public function getSlaPlanId()
    {
        return $this->slaPlanId;
    }

    /**
     * @return string
     */
    public function getSlaPlanExpiry()
    {
        return $this->slaPlanExpiry;
    }

    /**
     * @return array
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $userGroupId
     */
    public function setUserGroupId($userGroupId)
    {
        $this->userGroupId = $userGroupId;
    }

    /**
     * @param mixed $userRole
     */
    public function setUserRole($userRole)
    {
        $this->userRole = $userRole;
    }

    /**
     * @param mixed $userOrganizationId
     */
    public function setUserOrganizationId($userOrganizationId)
    {
        $this->userOrganizationId = $userOrganizationId;
    }

    /**
     * @param mixed $salutation
     */
    public function setSalutation($salutation)
    {
        $this->salutation = $salutation;
    }

    /**
     * @param mixed $userExpiry
     */
    public function setUserExpiry($userExpiry)
    {
        $this->userExpiry = $userExpiry;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @param mixed $designation
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param mixed $dateLine
     */
    public function setDateLine($dateLine)
    {
        $this->dateLine = $dateLine;
    }

    /**
     * @param mixed $lastVisit
     */
    public function setLastVisit($lastVisit)
    {
        $this->lastVisit = $lastVisit;
    }

    /**
     * @param mixed $isEnabled
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;
    }

    /**
     * @param mixed $timeZone
     */
    public function setTimeZone($timeZone)
    {
        $this->timeZone = $timeZone;
    }

    /**
     * @param mixed $enabledSt
     */
    public function setEnabledSt($enabledSt)
    {
        $this->enabledSt = $enabledSt;
    }

    /**
     * @param mixed $slaPlanId
     */
    public function setSlaPlanId($slaPlanId)
    {
        $this->slaPlanId = $slaPlanId;
    }

    /**
     * @param mixed $slaPlanExpiry
     */
    public function setSlaPlanExpiry($slaPlanExpiry)
    {
        $this->slaPlanExpiry = $slaPlanExpiry;
    }

    /**
     * @param array $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}
