<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kiosk extends Model
{
    use HasFactory;

    protected $table = 'kiosks';

    protected $primaryKey = 'kiosk_id';

    // Remove $incrementing property to make the primary key auto-incrementing
    // public $incrementing = false;

    protected $fillable = [
        'application_id',
        'user_id',
        'payment_id',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
