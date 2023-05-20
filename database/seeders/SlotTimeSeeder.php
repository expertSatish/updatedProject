<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SlotTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\SlotTime::insert([
            [
                'minute'=>15                
            ],[
                'minute'=>30
            ],[
                'minute'=>45
            ],[
                'minute'=>60
            ]
        ]);
    }
}
