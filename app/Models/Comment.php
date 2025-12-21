<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = ['comment', 'userid', 'postid'];

    // ✅ FIX: link comment to its user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userid', 'id');
    }
}
