<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\services;

use indigerd\kayako\models\User as UserModel;

class User extends BaseService
{
    public function create(array $params = [])
    {
        // path /Base/User
        $path = '/Base/User';
        $data = $this->post($path, $params);
        return $this->parseResponse($data, 'users', UserModel::class);
    }

    public function update($id, array $params = [])
    {
        // path /Base/User/$id$
        $path = '/Base/User/' . (int)$id;
        $data = $this->put($path, $params);
        return $this->parseResponse($data, 'users', UserModel::class);
    }

    public function getUser($id)
    {
        // path /Base/User/$id$
        $path = '/Base/User/' . (int)$id;
        $data = $this->get($path);
        return $this->parseResponse($data, 'users', UserModel::class);
    }
}
