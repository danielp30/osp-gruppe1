<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RegistrationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $registrations = [
            [
                'user_id' => 1,
                'registration_active' => true,
                'date_friday' => Carbon::now()->format('Y-m-d'),
                'date_saturday' => Carbon::now()->addDay(1)->format('Y-m-d'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'registration_active' => false,
                'date_friday' => Carbon::now()->addWeek(1)->format('Y-m-d'),
                'date_saturday' => Carbon::now()->addWeek(1)->addDay(1)->format('Y-m-d'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('registrations')->insert($registrations);
    }
}
