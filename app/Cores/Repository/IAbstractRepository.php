<?php

namespace App\Cores\Repository;

use Prettus\Repository\Contracts\RepositoryInterface;

interface IAbstractRepository extends RepositoryInterface
{
    public function firstWhere($where, array $column = ['*']);
    public function createMany(array $payload, bool $isTimeStamp = true);
}