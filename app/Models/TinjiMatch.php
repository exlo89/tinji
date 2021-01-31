<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TinjiMatch
 * @package App\Models
 * @mixin Eloquent
 */
class TinjiMatch extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'matches';
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
        return $this->hasMany(Message::class,'match_id');

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
