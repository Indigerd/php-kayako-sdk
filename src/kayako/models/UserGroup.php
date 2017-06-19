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
}
