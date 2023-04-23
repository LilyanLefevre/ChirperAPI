<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rechirp extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['chirp_id', 'user_id'];

    public function chirp(): HasOne{
        return $this->hasOne(Chirp::class, 'id', 'chirp_id');
    }

    public function user(): HasOne{
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
