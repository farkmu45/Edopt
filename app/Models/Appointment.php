<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function child()
    {
        return $this->belongsTo(Child::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
