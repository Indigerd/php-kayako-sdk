<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\models;

use SimpleXMLElement;

interface ModelInterface
{
    public function __construct(array $data = []);
    public static function fromXml(SimpleXMLElement $xml);
    public function toArray();
}
