<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['content','userid','categoryid'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function reactions()
    {
        return $this->hasMany(Reaction::class , 'postid');
    }

    public function reactionCount()
    {
        return $this->reactions()->count();
    }
}

