<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function likes(): HasMany{
        return $this->hasMany(ChirpLike::class, 'chirp_id');
    }
    public function rechirps(): HasMany{
        return $this->hasMany(Rechirp::class, 'chirp_id');
    }
}
