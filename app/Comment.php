<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CommentReply;

class Comment extends Model
{
    //

    protected $fillable = [
        'post_id',
        'author',
        'email',
        'is_active',
        'body',
        'photo'
    ];
    public function replies() {
        return $this -> hasMany('App\CommentReply');
    }

    public function photo(){
        return $this -> hasMany('App\Photo');
    }

    public function post(){
        return $this -> belongsTo('App\Post');
    }

}
