<?php

namespace App\Repositories;

use App\Exceptions\LittleDestroyException;
use App\Models\Author;

class AuthorRepository implements RepositoryInterface
{
    /**
     * The model instance
     */
    private $model;

    /**
     * Create a new repository instance.
     *
     * @param Author $model
     */
    public function __construct(Author $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new Eloquent model
     *
     * @param array $params
     * @return int
     */
    public function store($params)
    {
        $authorModel = $this->model->create($params);
        return $authorModel->getId();
    }

    /**
     * Update existing Eloquent model
     *
     * @param array $params
     * @param int $id
     * @return int
     */
    public function update($params, $id)
    {
        $updatedAuthor = $this->model->find($id);
        $updatedAuthor->update($params);
        return $updatedAuthor->getId();
}

    /**
     * Get all existing Eloquent models
     *
     * @param string|null $filter
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getList($filter = null)
    {
        return $this->model->all();
    }

    /**
     * Get the specified model
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function show($id)
    {
        return $this->model->getProfile($id);
    }

    /**
     * Remove existing Eloquent model
     *
     * @param int $id
     * @throws LittleDestroyException
     */
    public function destroy($id)
    {
        $count = $this->model->destroy($id);
        if ($count == 0) {
            throw new LittleDestroyException;
        }
    }
}
