<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Child;
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

        $this->call(IndoRegionProvinceSeeder::class);
        $this->call(IndoRegionRegencySeeder::class);
        $this->call(IndoRegionDistrictSeeder::class);

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
            'province_id' => 35,
            'regency_id' => 3511,
            'district_id' => 3511050,
            'image_url' => 'https://picsum.photos/400/400?random=23',
            'latitude' => '-7.912630224250118',
            'longitude' => '113.82122543338967',
            'address' => 'test',
            'opening_hours' => '12:00',
            'closing_hours' => '12:45',
        ]);

        Child::create([
            'name' => 'BWS 1',
            'gender' => 'MALE',
            'age' => 5,
            'additional_info' => 'sdfjldsafds',
            'is_adopted' => false,
            'orphanage_id' => 11
        ]);

        Child::create([
            'name' => 'NAGH BWS NIECH',
            'gender' => 'FEMALE',
            'age' => 6,
            'additional_info' => 'sdfjldsafds',
            'is_adopted' => false,
            'orphanage_id' => 11
        ]);
    }
}
