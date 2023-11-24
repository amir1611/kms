<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Witness extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'phonenumber'
        
    ];

    public function witness(){
        return $this->hasOne(Application::class);
    }
}
