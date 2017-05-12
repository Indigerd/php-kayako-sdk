<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\models;

use SimpleXMLElement;

interface ModelInterface
{
    public static function fromXml(SimpleXMLElement $xml);
}
