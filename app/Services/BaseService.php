<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class BaseService {

    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function new() {
        return new $this->model();
    }


    public function find(int $id) {
        $data = $this->model->find($id);

        if(!$data) {
            return false;
        }
        
        return $data;
    }

    public function listAll() {
        return $this->model->all();
    }

    public function listLasts() {
        return $this->model->latest()->get();
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