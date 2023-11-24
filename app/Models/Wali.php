<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'phonenumber',
        'address',
        'relationship'
    ];

    public function wali(){
        return $this->hasOne(Application::class);
    }
}
