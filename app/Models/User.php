<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable implements MustVerifyEmail
{
	use HasApiTokens, HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'ic',
		'staff_id',
		'role',
		'name',
		'gender',
		'contact',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'password' => 'hashed',
	];

    /**SET THE ROLE
     * KIOSK PARTICIPANT=0
     * PUPUK ADMIN=1
     * ADMIN=2
	 * FK-TECHNICAL=3
	 * FK-BURSART = 4
     */
	protected function role(): Attribute
	{
		return new Attribute(
			get: fn ($value) =>  ["user", "pupuk-admin", "admin", "fk-technical", "fk-bursary"][$value],
		);
	}

	public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
}
