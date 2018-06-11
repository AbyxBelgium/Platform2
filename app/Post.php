<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }

    public function user($user=null) {
        if ($user == null) {
            return $this->belongsTo('App\User');
        } else {
            $this->user()->associate($user);
        }
    }

    public function category($category=null) {
        if ($category == null) {
            return $this->belongsTo('App\Category');
        } else {
            $this->category()->associate($category);
        }
    }
}
