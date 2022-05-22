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

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function regency()
    {
        return  $this->belongsTo(Regency::class);
    }

    public function toSearchableArray()
    {
        $record = $this->toArray();

        $record['province'] = $this->province->name;
        $record['regency'] = $this->regency->name;
        $record['district'] = $this->district->name;

        $record['_geoloc'] = [
            'lat' => $record['latitude'],
            'lng' => $record['longitude'],
        ];

        unset(
            $record['created_at'],
            $record['updated_at'],
            $record['deleted_at'],
            $record['latitude'],
            $record['longitude'],
            $record['regency_id'],
            $record['province_id'],
            $record['district_id'],
            $record['id'],
            $record['image_url'],
            $record['opening_hours'],
            $record['closing_hours'],
        );
        return $record;
    }
}
