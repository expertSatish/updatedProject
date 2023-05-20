<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Cms::create([
            'title'=>'Request a time',
            'description'=>'Share all of the times that work for you & the expert will accept one'
        ],[
            'title'=>'Gift a session',
            'description'=>'Gift a session to a friend, family, or coworker'
        ],
        [
            'title'=>'',
            'description'=>'100% of proceeds will be donated to 776 Foundation'
        ]
        );
    }
}
