<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        Admin::create([
            'name' => 'Faruk Maulana',
            'email' => 'fark@admin.com',
            'password' =>  Hash::make('password'),
            'remember_token' => null
        ]);
    }
}
