<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kiosk extends Model
{
    use HasFactory;

    protected $table = 'kiosks';

    protected $primaryKey = 'id';


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

    // Kiosk.php

public function application()
{
    return $this->belongsTo(applications::class, 'application_id', 'application_id');
}

}
