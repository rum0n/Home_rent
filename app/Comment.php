<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = ['user_id', 'post_id', 'parent_id', 'body'];

    /*
      The belongs to Relationship
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /*
      The has Many Relationship
    */
    public function replies()
    {
        return $this->hasMany('App\Comment', 'parent_id');
    }

}
