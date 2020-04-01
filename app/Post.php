<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Photo;
use App\Comment;
use Cviebrock\EloquentSluggable\Sluggable;
class Post extends Model
{
    //

    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
            ]
        ];
    }


    protected $fillable = [
        'user_id',
        'photo_id',
        'category_id',
        'title',
        'body'

    ];

    public function user() {
        return $this -> belongsTo('App\User');
    }

    public function category() {
        return $this -> belongsTo('App\Category');
    }

    public function photo() {
        return $this -> belongsTo('App\Photo');
    }

    public function comments() {
        return $this -> hasMany('App\Comment');
    }
}
