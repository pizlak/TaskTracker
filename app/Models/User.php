<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model implements Authenticatable
{
    use HasFactory;
    protected $guarded = false;
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function tasks(): hasMany
    {
        return $this->hasMany(Task::class, 'user_id', 'id');
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Commentary::class, 'user_id', 'id');
    }
    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'user_id', 'id');
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
