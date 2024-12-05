<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class score extends Model
{
    protected $fillable = [
        'score',
        'user_id',
        'last_take'
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
