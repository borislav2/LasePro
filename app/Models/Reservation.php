<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'message',
        'preferred_date',
        'status',
    ];

    protected $casts = [
        'preferred_date' => 'date',
    ];
}
