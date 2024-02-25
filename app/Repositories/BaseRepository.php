<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected abstract function model();

    public function index(): Collection
    {
        return $this->model()->get();
    }

    public function show(int $id): Model
    {
        return $this->model()->find($id);
    }

    public function store(array $data): Model
    {
        return $this->model()->create($data);
    }

    public function update(int $id, array $data): Model
    {
        return $this->model()->find($id)->update($data);
    }

    public function destroy(int $id)
    {
        return $this->model()->destroy($id);
    }
}
