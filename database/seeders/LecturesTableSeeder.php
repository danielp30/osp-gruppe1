<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LecturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lectures = [
            [
                'user_id' => 1,
                'date' => Carbon::now()->format('Y-m-d'),
                'status' => 'geplant',
                'subject' => 'Test 1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'date' => Carbon::now()->addDay(1)->format('Y-m-d'),
                'status' => 'abgeschlossen',
                'subject' => 'Test 2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'date' => Carbon::now()->addDay(1)->format('Y-m-d'),
                'status' => 'ausstehend',
                'subject' => 'Test 3',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('lectures')->insert($lectures);
    }
}
