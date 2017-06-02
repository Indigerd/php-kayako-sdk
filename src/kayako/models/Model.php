<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\models;

abstract class Model implements ModelInterface
{
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $val) {
            if (property_exists($this, $key)) {
                $this->{$key} = $val;
            }
        }
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}
