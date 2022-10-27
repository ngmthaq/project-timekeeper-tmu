<?php

namespace App\Repositories;

abstract class BaseRepo implements BaseRepoInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }

    public function all(string $orderBy = 'id', string $orderDir = 'asc'): mixed
    {
        return $this->model->orderBy($orderBy, $orderDir)->get();
    }

    public function find(int $id): mixed
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $attributes): mixed
    {
        $record = $this->model->create($attributes);

        return $this->find($record->id);
    }

    public function update(int $id, array $attributes): mixed
    {
        $record = $this->find($id);
        $record->update($attributes);

        return $this->find($id);
    }

    public function delete(int $id): bool
    {
        $record = $this->find($id);

        return $record->delete();
    }

    public function destroy(array $attributes): int
    {
        return $this->model->destroy($attributes);
    }
}
