<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incentive extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'applicant_name',
        'job',
        'job_type',
        'salary',
        'date',
        'status',
        'heir',
        'docs'
    ];
}
