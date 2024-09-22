<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {
    use HasFactory;

    protected $table = 'schedules';

    protected $fillable = [
        'date',
        'time',
        'location',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'string', // Ensure 'time' is cast to string if it's stored as a string
    ];
}
