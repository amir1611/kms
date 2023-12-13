<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kiosk extends Model
{
    use HasFactory;

    protected $table = 'kiosks';

    protected $primaryKey = 'kiosk_id';

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
