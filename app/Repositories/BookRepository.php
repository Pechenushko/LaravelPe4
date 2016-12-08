<?php

namespace App\Repositories;

use App\Exceptions\LittleDestroyException;
use App\Models\Book;

class BookRepository implements RepositoryInterface
{
    /**
     * The model instance
     */
    private $model;

    /**
     * Create a new repository instance.
     *
     * @param Book $model
     */
    public function __construct(Book $model)
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
        $bookModel = $this->model->create($params);
        return $bookModel->getId();
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
        $updatedBook = $this->model->find($id);
        $updatedBook->update($params);
        return $updatedBook->getId();
}

    /**
     * Get all existing Eloquent models
     *
     * @param string|null $filter
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getList($filter = null)
    {
        if ($filter == '') {
            $this->model->getList();
        }
        return $this->model->getFilteredList($filter);
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
