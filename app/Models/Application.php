<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
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
        'age',
        'spouse_id',
        'applicant_id',
        'wali_id',
        "witness_id",
    ];


    public function applicant()
    {
        return $this->belongsTo(Applicant::class,'applicant_id');
    }

    public function spouse()
    {
        return $this->belongsTo(Spouse::class, 'spouse_id');
    }

    public function wali()
    {
        return $this->belongsTo(Wali::class, 'wali_id');
    }

    public function witness()
    {
        return $this->belongsTo(Witness::class,'witness_id');
    }

}

// apl_Num
// sp_IcNum
// app_IcNum
// apl_date
// apl_location
// wed_date
// wit_IcNum
// inc_apl_Num
// staff_IcNum
// wali_IcNum
