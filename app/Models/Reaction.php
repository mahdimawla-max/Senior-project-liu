<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable = ['status', 'postid' , 'userid'];
    public function user()
    {
        return $this->belongsTo(User::class , 'userid');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'postid');
    }
}
