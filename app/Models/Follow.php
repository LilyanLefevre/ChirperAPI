<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Follow extends Model
{
    use HasFactory, HasTimestamps;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['follower_id', 'followed_id'];

    public function follower(): HasOne{
        return $this->hasOne(User::class, 'id', 'follower_id');
    }

    public function followed(): HasOne{
        return $this->hasOne(User::class, 'id', 'followed_id');
    }
}
