<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\models;

use SimpleXMLElement;

class TicketCustomField extends Model
{
    protected $id;
    protected $name;
    protected $title;
    protected $value;

    public static function fromXml(SimpleXMLElement $xml)
    {
        $field = new self();
        $mapping = [
            'id'    => 'id',
            'name'  => 'name',
            'title' => 'title',
        ];
        foreach ($xml->attributes() as $key => $val) {
            if (isset($mapping[$key])) {
                $field->{$mapping[$key]} = (string)$val;
            }
        }
        $field->value = (string)$xml;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
