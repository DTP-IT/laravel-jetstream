<?php

namespace App\Repositories;

interface BaseContract
{
    public function getAll();
    public function getOnlySoftDelete();
    public function getById($id);
    public function deleteById($id);
    public function store($details);
    public function update($details, $id);
    public function restore($id);
    public function getModel();
}
