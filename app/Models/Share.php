<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    protected $fillable = ['description' , 'postid'];
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_shares');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'postid');
    }

}
