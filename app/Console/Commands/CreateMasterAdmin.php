<?php

namespace App\Console\Commands;

use App\Console\Commands\Concerns\WithInputValidation;
use App\Models\Admin;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateMasterAdmin extends Command
{
    use WithInputValidation;
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
        $name = $this->askWithValidation('Masukkan nama', [
            'required'
        ], 'nama');

        $email = $this->askWithValidation('Masukkan email (dengan domain @edopt.com)', [
            'required', 'unique:admins,email', 'ends_with:@edopt.com', 'email'
        ], 'email');

        $password = $this->askWithValidation('Masukkan password', ['required', 'min:8'], 'password', true);
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
