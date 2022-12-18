<?php

namespace App\Cores\Repository;

use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;

abstract class AbstractRepository extends BaseRepository implements IAbstractRepository
{
    public function firstWhere($where, array $column = ['*'])
    {
        $this->applyScope();
        $data = $this->model->where($where)->first($column);
        $this->resetModel();
        $this->resetScope();
        return $this->parserResult($data);
    }

    public function createMany(array $payload, bool $isTimeStamp = true)
    {
        $this->applyScope();
        if ($isTimeStamp) {
            foreach ($payload as &$v) {
                $v['created_at'] = Carbon::now();
                $v['updated_at'] = Carbon::now();
            }
        }
        $data = $this->model->insert($payload);
        $this->resetScope();
        $this->resetModel();
        return $data;
    }
}