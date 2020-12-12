<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function match()
    {
        return $this->belongsTo(Match::class);
    }

    /**
     * @return BelongsTo
     */
    public function from()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
}
