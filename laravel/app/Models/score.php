<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Score extends Model
{
    protected $fillable = [
        'score',
        'last_take',
        'user_id',
    ];
    public $timestamps = false; 

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
