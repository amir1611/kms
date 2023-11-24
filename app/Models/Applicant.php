<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;
    protected $fillable = [

        'id',
        'user_id',
        'birthdate',
        'age',
        'nationality',
        'houseaddress',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function consultation()
    {
        return $this->hasMany(Consultation::class);
    }
    public function prep_course()
    {
        return $this->hasMany(Prep_course::class);
    }

    public function application()
    {
        return $this->hasMany(Application::class);
    }
}
