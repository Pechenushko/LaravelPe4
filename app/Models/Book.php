<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'author_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get id (primary key)
     *
     * @return int
     */
    public function getId()
    {
        return $this->getAttributeValue($this->primaryKey);
    }

    /**
     * Get the author record associated with the book.
     */
    public function author()
    {
        return $this->belongsTo('App\Models\Author');
    }

    /**
     * Get list of books with filter
     *
     * @param $filter
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getFilteredList($filter)
    {
        $sql = $this->select('books.name as book_name', 'authors.name as author_name')
            ->leftJoin('authors', 'authors.' . $this->primaryKey, '=', 'books.author_id')
            ->where('authors.name', 'like', "%{$filter}%");
        return $sql->get();
    }


    /**
     * Get list of books without filter
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getList()
    {
        return $this->with('author')->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getProfile($id)
    {
        return $this->with('author')->where($this->primaryKey, $id)->get();
    }
}
