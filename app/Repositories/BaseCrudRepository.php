<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseCrudRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function insertItens(array $dados)
    {
        return $this->model->insert($dados);
    }
    public function insertAndReturnId(array $dados)
    {
        return $this->model->insertGetId($dados);
    }

    public function updateItens(array $dados, $id)
    {
        return $this->model->find($id)->update($dados);
    }

    public function deleteItens($id)
    {
        return $this->model->find($id)->delete();
    }
}
