<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Orphanage extends Model
{
    use Searchable;
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function children()
    {
        return $this->hasMany(Child::class);
    }

    public function toSearchableArray()
    {
        $record = $this->toArray();

        $record['_geoloc'] = [
            'lat' => $record['latitude'],
            'lng' => $record['longtitude']
        ];

        unset($record['created_at'], $record['updated_at'], $record['deleted_at'], $record['latitude'], $record['longtitude']);
        return $record;
    }
}
