<?php
// app/Models/PasswordlessToken.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordlessToken extends Model
{
    protected $fillable = ['email', 'token', 'expires_at', 'is_used', 'attempts'];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_used' => 'boolean',
        'attempts' => 'integer'
    ];
}
