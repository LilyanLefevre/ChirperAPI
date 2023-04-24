<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chirp extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['author_id', 'content'];

    public function author(): HasOne{
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function likes(): HasMany{
        return $this->hasMany(ChirpLike::class, 'id', 'chirp_id');
    }

    public function rechirps(): HasMany{
        return $this->hasMany(Rechirp::class, 'id', 'chirp_id');
    }
}
