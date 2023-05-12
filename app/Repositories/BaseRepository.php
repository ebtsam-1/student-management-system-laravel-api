<?php

namespace App\Repositories;

class BaseRepository
{
    public function __construct(public $model, public $searchColumn)
    {
    }

    public function get(
        $filters = [],
        $search = false,
        $with = false,
        $selects = [],
        $orderBy = false,
        $pagination = true,
        $paginationNum = 15,
    )
    {
        $filters = $this->prepareFilters($filters);
        $query = $this->model->where($filters);
        $query = $search ? $query->where($this->searchColumn, $search): $query;
        $query = $with ? $query->with($with) : $query;
        $query = $pagination ? $query->paginate($paginationNum) : $query->get();

        return $query;
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function update($model, $data)
    {
        return $model->update($data);
    }

    public function destroy($model)
    {
        return $model->delete();
    }

    public function prepareFilters($filters)
    {
        return array_diff($filters, ['*']);
    }
}
