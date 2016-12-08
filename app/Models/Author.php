<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

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
     * Get the book record associated with the author.
     */
    public function book()
    {
        return $this->hasMany('App\Models\Book');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getProfile($id)
    {
        return $this->withCount('book')->where($this->primaryKey, $id)->get();
    }
}
