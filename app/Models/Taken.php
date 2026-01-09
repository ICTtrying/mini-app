<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Taken extends Model
{
    protected $table = 'taken';

    protected $fillable = [
        'user_id',
        'titel',
        'omschrijving',
        'deadline',
        'type',
        'status',
        'prioriteit',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

