<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'method',
        'status',
        'reference',
    ];

    /**
     * Relation vers l'utilisateur propriétaire du don.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
