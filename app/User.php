<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //
    protected $fillable = [
        'username',
        'password'
    ];

    /**
     * Get user articles
     *
     * @return HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Article', 'user_id');
    }
}
