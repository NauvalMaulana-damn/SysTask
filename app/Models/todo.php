<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class todo extends Model
{
    protected $fillable = ['title', 'status', 'user_id'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
