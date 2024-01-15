<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $table = 'complaints';

    protected $primaryKey = 'id';

    protected $fillable = [
      'user_id',
      'date_of_filling_form',
      'business_name',
      'complaint_category',
      'complaint_information',
      'complaint_justification',
      'status',
      'work_order',
    ];


    public function kiosk()
    {
      //  return $this->belongsTo(Kiosk::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
