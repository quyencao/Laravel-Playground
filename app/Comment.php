<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['username', 'comment', 'parent_id'];

    public function comments() {
        return $this->hasMany('App\Comment', 'parent_id', 'id');
    }
}
