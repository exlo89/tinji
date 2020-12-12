<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Match extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
    ];

    /**
     * @return HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);

    }

    /**
     * @return mixed
     */
    public function getLastMessageAttribute()
    {
        return $this->messages()->get()->last();
    }

    /**
     * @return BelongsTo
     */
    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    /**
     * @return BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
