<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$users = [
			[
				'ic' => '485967363937',
				'name' => 'admin',
				'gender' => 'male',
				'staff_id' => 'stf321',
				'email' => 'admin@gmail.com',
				'contact' => '0987654321',
                'email_verified_at' => '2023-06-03 09:16:17',
				'role' => 2,
				'password' => bcrypt('1234'),
			],

            [
				'ic' => '111122223333',
				'name' => 'amir',
				'gender' => 'male',
				'staff_id' => 'stf2020',
				'email' => 'staff@gmail.com',
				'contact' => '0387451298',
                'email_verified_at' => '2023-06-03 09:16:17',
				'role' => 1,
				'password' => bcrypt('1234'),
			],


            [
				'ic' => '022134321987',
				'name' => 'ali',
				'gender' => 'male',
				'staff_id' => 'usr2123',
				'email' => 'user@gmail.com',
				'contact' => '0387988765',
                'email_verified_at' => '2023-06-09 06:16:17',
				'role' => 0,
				'password' => bcrypt('1234'),
			],

            [
				'ic' => '111222333444',
				'name' => 'chua',
				'gender' => 'male',
				'staff_id' => '',
				'email' => 'chua@gmail.com',
				'contact' => '0387988765',
                'email_verified_at' => '2023-06-09 06:16:17',
				'role' => 0,
				'password' => bcrypt('password'),
			],

		];

		foreach ($users as $key => $user) {
			User::create($user);
		}
	}
}
