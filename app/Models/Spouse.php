<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'birthdate',
        'email',
        'ic',
        'gender',
        'phonenumber',
        'nationality',
        'address',
        'age'
    ];

    public function posts()
    {
        return $this->hasMany(Consultation::class, 'cons_id');
    }
}

