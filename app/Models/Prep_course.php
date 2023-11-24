<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prep_course extends Model
{
    use HasFactory;
    protected $fillable = [

        'id',
        'app_id',
        'sp_id',
        'paymentProof',
        'ref_location_id'

    ];

    public function applicant()
    {
        return $this->belongsTo(User::class, 'app_id');
    }

    public function spouse()
    {
        return $this->belongsTo(Spouse::class, 'sp_id');
    }

    public function location()
    {
        return $this->belongsTo(Reference::class, 'ref_location_id');
    }
}
