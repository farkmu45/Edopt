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

    protected $appends = ['isMaster'];

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

    public function getIsMasterAttribute()
    {
        return $this->orphanage_id ? false : true;
    }

    public function canAccessFilament(): bool
    {
        return str_ends_with($this->email, '@admin.com');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($admin) {
            $admin['password'] = Hash::make($admin['password']);
        });

        static::updating(function (Admin $admin) {
            $admin['password'] = Hash::make($admin['password']);
        });
    }
}
