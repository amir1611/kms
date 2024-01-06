<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Payments extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'kiosk_id',
        'user_id',
        'application_id',
        'payment_type',
        'payment_amount',
        'payment_receipt',
        'payment_status',
        'payment_date',
        'payment_comment',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kiosk()
    {
        return $this->hasOne(Kiosk::class, 'payment_id', 'payment_id');
    }
}
