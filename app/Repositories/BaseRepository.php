<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

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
        $orderBy = 'id',
        $order = 'desc',
        $pagination = true,
        $paginationNum = 15,
    )
    {
        $filters = $this->prepareFilters($filters);
        $query = $this->model->where($filters);
        $query = $search ? $query->where($this->searchColumn, $search): $query;
        $query = $with ? $query->with($with) : $query;
        $query->orderBy($orderBy, $order);
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

    public function saveImage($image)
    {
        $img = Image::make($image->getRealPath());
        $img->stream();
        $name = date("y/m/d") . "/" . rand(1111,9999) . "." . $image->getClientOriginalExtension();
        Storage::disk('public')->put($name, $img,'public');

        return $name;
    }

    public function massInsert($data)
    {
        $this->model->insert($data);
    }
}
