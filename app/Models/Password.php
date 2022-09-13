<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Password extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'password', 'users_id'
    ];

    /**
     * Produkt ma przypisaną jedną kategorię
     *
     * @return void
     */
}
