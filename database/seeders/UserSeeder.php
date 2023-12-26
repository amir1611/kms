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

			//admin
			[
				'ic' => '124397489324',
				'name' => 'Admin',
				'gender' => 'male',
				'staff_id' => 'admin01',
				'email' => 'admin@gmail.com',
				'contact' => '0987896564',
				'email_verified_at' => '2023-06-03 09:16:17',
				'role' => 2,
				'password' => bcrypt('1234'),
			],

			//Pupuk admin
			[
				'ic' => '111122223333',
				'name' => 'Amira Binti Rosli',
				'gender' => 'Female',
				'staff_id' => 'pupukAdmin01',
				'email' => 'pupukadmin@gmail.com',
				'contact' => '0387298768',
				'email_verified_at' => '2023-06-03 09:16:17',
				'role' => 1,
				'password' => bcrypt('1234'),
			],

			//FK Techincal
			[
				'ic' => '022134321987',
				'name' => 'ali',
				'gender' => 'male',
				'staff_id' => 'tech01',
				'email' => 'tech@gmail.com',
				'contact' => '0387431908',
				'email_verified_at' => '2023-06-09 06:16:17',
				'role' => 3,
				'password' => bcrypt('1234'),
			],

			//Fk Bursary 
			[
				'ic' => '022134321222',
				'name' => 'Siti hawa',
				'gender' => 'Female',
				'staff_id' => 'bursary01',
				'email' => 'bursary@gmail.com',
				'contact' => '0387345436',
				'email_verified_at' => '2023-06-09 06:16:17',
				'role' => 4,
				'password' => bcrypt('1234'),
			],

			//Kiosk Participant - 1
			[
				'ic' => '021116101087',
				'name' => 'Muhammad Aziq',
				'gender' => 'male',
				// 'staff_id' => '',
				'email' => 'aziq@gmail.com',
				'contact' => '0192291001',
				'email_verified_at' => '2023-06-09 06:16:17',
				'role' => 0,
				'password' => bcrypt('1234'),
			],

			//Kiosk Participant - 2
			[
				'ic' => '045467876546',
				'name' => 'Chua',
				'gender' => 'male',
				// 'staff_id' => '',
				'email' => 'chua@gmail.com',
				'contact' => '0187231909',
				'email_verified_at' => '2023-06-09 06:16:17',
				'role' => 0,
				'password' => bcrypt('1234'),
			],

			//Kiosk Participant - 3
			[
				'ic' => '050989786564',
				'name' => 'Bakri bin Ahmad',
				'gender' => 'male',
				// 'staff_id' => '',
				'email' => 'bakri@gmail.com',
				'contact' => '0192342908',
				'email_verified_at' => '2023-06-09 06:16:17',
				'role' => 0,
				'password' => bcrypt('1234'),
			],

			//Kiosk Participant - 4
			[
				'ic' => '013454278678',
				'name' => 'Tusharan',
				'gender' => 'male',
				// 'staff_id' => '',
				'email' => 'tusharan@gmail.com',
				'contact' => '0122867897',
				'email_verified_at' => '2023-06-09 06:16:17',
				'role' => 0,
				'password' => bcrypt('1234'),
			],

			//Kiosk Participant - 5
			[
				'ic' => '074565456783',
				'name' => 'Alia',
				'gender' => 'female',
				// 'staff_id' => '',
				'email' => 'alia@gmail.com',
				'contact' => '0178865786',
				'email_verified_at' => '2023-06-09 06:16:17',
				'role' => 0,
				'password' => bcrypt('1234'),
			],

			//Kiosk Participant - 6
			[
				'ic' => '093456453245',
				'name' => 'Amira',
				'gender' => 'female',
				// 'staff_id' => '',
				'email' => 'amira@gmail.com',
				'contact' => '0132345676',
				'email_verified_at' => '2023-06-09 06:16:17',
				'role' => 0,
				'password' => bcrypt('1234'),
			],

		];


		foreach ($users as $key => $user) {
			User::create($user);
		}
	}
}
