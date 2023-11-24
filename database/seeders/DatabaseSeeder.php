<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
      UserSeeder::class
    ]);

    $this->registerReference();
    $this->registerApplicant();
  }
  
  public function registerApplicant()
  {
    $datas = [
      //applicant
      [
        'user_id' => '3',
      ],
      [
        'user_id' => '4',
      ],
    ];
    
    foreach ($datas as $data) {
      DB::table('applicants')->insert($data);
    }
  }
  public function registerReference()
  {
    $datas = [
      //consultation-status
      [
        'name' => 'consultation-status',
        'code' => 1,
        'value' => 'Pending',
      ],
      [
        'name' => 'consultation-status',
        'code' => 2,
        'value' => 'Declined',
      ],
      [
        'name' => 'consultation-status',
        'code' => 3,
        'value' => 'Approved',
      ],
      //location
      [
        'name' => 'location',
        'code' => 1,
        'value' => 'PEJABAT AGAMA ISLAM CAMERON HIGHLANDS',
      ],
      [
        'name' => 'location',
        'code' => 2,
        'value' => 'PEJABAT AGAMA ISLAM LIPIS',
      ],
      [
        'name' => 'location',
        'code' => 3,
        'value' => 'PEJABAT AGAMA ISLAM JERANTUT',
      ],
      [
        'name' => 'location',
        'code' => 4,
        'value' => 'PEJABAT AGAMA ISLAM RAUB',
      ],
      [
        'name' => 'location',
        'code' => 5,
        'value' => 'PEJABAT AGAMA ISLAM TERMERLOH',
      ],
      [
        'name' => 'location',
        'code' => 6,
        'value' => 'PEJABAT AGAMA ISLAM BENTONG',
      ],
      [
        'name' => 'location',
        'code' => 7,
        'value' => 'PEJABAT AGAMA ISLAM MARAN',
      ],
      [
        'name' => 'location',
        'code' => 8,
        'value' => 'PEJABAT AGAMA ISLAM KUANTAN',
      ],
      [
        'name' => 'location',
        'code' => 9,
        'value' => 'PEJABAT AGAMA ISLAM BERA',
      ],
      [
        'name' => 'location',
        'code' => 10,
        'value' => 'PEJABAT AGAMA ISLAM PEKAN',
      ],
      [
        'name' => 'location',
        'code' => 11,
        'value' => 'PEJABAT AGAMA ISLAM ROMPIN',
      ],
      //department
      [
        'name' => 'department',
        'code' => 1,
        'value' => 'Divorce',
      ],
      [
        'name' => 'department',
        'code' => 2,
        'value' => 'Consultation',
      ],
      [
        'name' => 'department',
        'code' => 3,
        'value' => 'Complaint',
      ],
      //slot
      [
        'name' => 'slot',
        'code' => 8,
        'value' => '10.30 am - 12.30 pm',
      ],
      [
        'name' => 'slot',
        'code' => 9,
        'value' => '12.30 am - 2.30 pm',
      ],
      [
        'name' => 'slot',
        'code' => 10,
        'value' => '2.30 am - 4.30 am',
      ],
      //complaint-type
      [
        'name' => 'complaint-type',
        'code' => 1,
        'value' => 'Unsatisfied Expert Feedback',
      ],
      [
        'name' => 'complaint-type',
        'code' => 2,
        'value' => 'Wrongly Assigned Research Area',
      ],
      [
        'name' => 'complaint-type',
        'code' => 3,
        'value' => 'Inapproriate Feedback',
      ],
    ];

    foreach ($datas as $data) {
      DB::table('references')->insert($data);
    }
  }
}
