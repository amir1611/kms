<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marriage_cer extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'application_id',
        'created_at',
        'updated_at'
    ];
    
    public function cert(){
        return $this->belongsTo(Applicant::class,'app_id');
    }
}
