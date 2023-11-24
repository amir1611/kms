<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marriage_card extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'certificate_id',
        'created_at',
        'updated_at'
    ];
    
    public function card(){
        return $this->hasOne(Marriage_cer::class);
    }
}
