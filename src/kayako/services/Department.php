<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\services;

use indigerd\kayako\models\Department as DepartmentModel;

class Department extends BaseService
{
    public function create(array $params = [])
    {
        // path /Base/Department/
        $path = '/Base/Department/';
        $data = $this->post($path, $params);
        return $this->parseResponse($data, DepartmentModel::class);
    }

    public function update($id, array $params = [])
    {
        // path /Base/Department/$id$
        $path = '/Base/Department/' . (int)$id;
        $data = $this->put($path, $params);
        return $this->parseResponse($data, DepartmentModel::class);
    }
}
