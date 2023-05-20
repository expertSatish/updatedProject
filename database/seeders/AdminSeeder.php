<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::create([
            'name' => 'expertbells',
            'email' => 'admin@expertbell.com',
            'password' => \Hash::make('123456'),
            'password_text' => '123456',
        ]);
    }
}
