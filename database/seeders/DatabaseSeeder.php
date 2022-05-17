<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Orphanage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Orphanage::factory(10)->create();
        \App\Models\Admin::factory(10)->create();
        \App\Models\Article::factory(10)->create();
        \App\Models\Child::factory(10)->create();
        \App\Models\User::factory(10)->create();
        \App\Models\Appointment::factory(10)->create();
        Admin::create([
            'name' => 'Faruk Maulana',
            'email' => 'fark@admin.com',
            'password' =>  Hash::make('password'),
            'remember_token' => null
        ]);

        Orphanage::create([
            'name' => 'Bondowoso',
            'latitude' => '-7.912630224250118',
            'longtitude' => '113.82122543338967',
            'location' => 'test',
            'opening_hours' => '12:00:01',
            'closed_hours' => '12:00:01',
        ]);
    }
}
