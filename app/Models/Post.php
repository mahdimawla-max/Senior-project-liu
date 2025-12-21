<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $fillable = ['content', 'userid', 'categoryid'];

    protected $primaryKey = 'post_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function reactions(): HasMany
    {
        return $this->hasMany(Reaction::class, 'postid', 'post_id');
    }

    public function reactionCount()
    {
        return $this->reactions()->count();
    }

    // ✅ ADD THIS (THIS FIXES THE 500 ERROR)
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'postid', 'post_id');
    }
}
