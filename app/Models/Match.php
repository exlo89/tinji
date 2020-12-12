<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Match extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);

    }

    /**
     * @return BelongsTo
     */
    public function host()
    {
        return $this->belongsTo(User::class,'host_id');
    }

    /**
     * @return BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(User::class,'client_id');
    }
}
