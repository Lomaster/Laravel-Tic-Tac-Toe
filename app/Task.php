<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get a user - an owner of a task
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
