<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ap\Models\User;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'executor',
        'customerId',
        'customer',
        'period',
        'description'
    ];

    protected $attributes = [
        'issued' => false,
        'accepted' => false
    ];
}
