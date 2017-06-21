<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\services;

use indigerd\kayako\models\CustomField as CustomFieldModel;

class CustomField extends BaseService
{
    public function getCustomFields()
    {
        // path /Base/CustomField
        $path = '/Base/CustomField';
        $data = $this->get($path);
        return $this->parseResponse($data, CustomFieldModel::class);
    }
}
