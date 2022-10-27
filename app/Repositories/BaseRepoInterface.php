<?php

namespace App\Repositories;

interface BaseRepoInterface
{
    /**
     * Get all records
     * @param string $orderBy
     * @param string $orderDir
     * @return mixed
     */
    public function all(string $orderBy = 'id', string $orderDir = 'asc'): mixed;

    /**
     * Find record by id
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed;

    /**
     * Create a new record
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes): mixed;

    /**
     * Update an existed record
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes): mixed;

    /**
     * Delete an existed record
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * Delete mutiple records by id
     * @param array $attributes
     * @return int
     */
    public function destroy(array $attributes): int;
}
