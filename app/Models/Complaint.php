<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $table = 'complaints';

    protected $primaryKey = 'complaint_id';

    protected $fillable = [
        'kiosk_id',
        'complaint_type',
        'complaint_description',
    ];


    public function kiosk()
    {
      //  return $this->belongsTo(Kiosk::class);
    }
}
