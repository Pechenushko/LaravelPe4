<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Create a new Eloquent model
     *
     * @param array $params
     * @return int
     */
    public function store($params);

    /**
     * Update existing Eloquent model
     *
     * @param array $params
     * @param int $id
     * @return int
     */
    public function update($params, $id);

    /**
     * Get all existing Eloquent models
     *
     * @param string|null $filter
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getList($filter = null);

    /**
     * Get the specified model
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function show($id);

    /**
     * Remove existing Eloquent model
     *
     * @param int $id
     */
    public function destroy($id);
}
