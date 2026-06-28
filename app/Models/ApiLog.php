<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApiLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'endpoint',
        'response_status',
        'response_time',
        'requested_at',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
    ];
}