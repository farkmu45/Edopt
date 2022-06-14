<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable implements FilamentUser
{
    use HasFactory;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'orphanage_id'
    ];

    public function orphanage()
    {
        return $this->belongsTo(Orphanage::class);
    }

    public function isMaster()
    {
        return $this->orphanage_id ? false : true;
    }

    public function canAccessFilament(): bool
    {
        return str_ends_with($this->email, '@edopt.com');
    }
}
