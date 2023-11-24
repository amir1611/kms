<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultant extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'created_by',
        'IcNum',
        'name',
        'email',
        'ref_department_id',
        'ref_location_id',
        'phoneNo'

    ];

    public function created_by()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function location()
    {
        return $this->belongsTo(Reference::class, 'ref_location_id');
    }

    public function department()
    {
        return $this->belongsTo(Reference::class, 'ref_department_id');
    }
}
