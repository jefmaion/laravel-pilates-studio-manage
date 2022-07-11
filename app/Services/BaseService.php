<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class BaseService {

    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }


    public function find(int $id) {
        return $this->model->find($id);
    }

    public function listAll() {
        return $this->model->all();
    }

    public function create($data) {
        return $this->model->create($data);
    }

    public function update($data, $id=0) {
        $item = $this->find($id);
        return $item->update($data);
    }

    public function delete(int $id) {
        return $this->model->destroy($id);
    }

}