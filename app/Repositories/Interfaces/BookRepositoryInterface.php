<?php

namespace App\Repositories\Interfaces;

use App\Repositories\BaseContract;

interface BookRepositoryInterface extends BaseContract
{
    public function getBookIsNotSoftDelete();
    public function getBookOnlySoftDelete();
    public function searchBook($key);
}
