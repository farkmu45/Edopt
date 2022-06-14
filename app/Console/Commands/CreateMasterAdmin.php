<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateMasterAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'edopt:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Buat admin master baru';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('Masukkan nama lengkap');
        $email = $this->ask('Masukkan email (dengan domain @edopt.com)');
        $password = $this->secret('Masukkan password');
        try {
            Admin::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password)
            ]);
            $this->info('Data admin berhasil dibuat, silahkan login');
        } catch (Exception $e) {
            $this->error('Terjadi kesalahan saat membuat data admin');
        }
    }
}
