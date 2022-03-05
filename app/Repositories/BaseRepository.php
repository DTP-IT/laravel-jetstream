<?php

namespace App\Repositories;

use App\Repositories\BaseContract;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseContract
{
    /**
     * @var Illuminate\Database\Eloquent\Model $model
     */
    protected $model;

    /**
     * Constructor
     *
     * @param Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /*
    |--------------------------------------------------------------------------
    | These functions below is a wrapper of model's basic functions
    |--------------------------------------------------------------------------
    */

    /**
     * find all
     *
     * @return Collection
     */
    public function getAll()
    {
        return $this->model->paginate();
    }

    /**
     * only find softDelete
     *
     * @return Collection
     */
    public function getOnlySoftDelete()
    {
        return $this->model->onlyTrashed()->paginate();
    }

    /**
     * findById function
     *
     * @param int|string $id
     * @return Object | Exception
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * destroy function
     *
     * @param int|string $id
     * @return int
     */
    public function deleteById($id)
    {
        $obj = $this->model->findOrFail($id);
        return $obj->delete();
    }

    /**
     * create function
     *
     * @param array $data
     * @return int
     */
    public function store($data)
    {
        return $this->model->create($data);
    }

    /**
     * update function
     *
     * @param array $data
     * @param int|string $id
     * @return int
     */
    public function update($data, $id)
    {
        $obj = $this->model->findOrFail($id);
        return $obj->update($data);
    }

    /** 
     * restore function
     *
     * @param int|string $id
     * @return int
     */
    public function restore($id)
    {
        return $this->model->withTrashed()->find($id)->restore();
    }

    public function getModel()
    {
        return $this->model;
    }
}
