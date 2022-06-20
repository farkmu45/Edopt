<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Child extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

    protected $guarded = ['id'];
    protected $table = 'children';
    protected $casts = [
        'is_adopted' => 'boolean',
        'age' => 'integer',
    ];


    public function orphanage()
    {
        return $this->belongsTo(Orphanage::class)->withTrashed();
    }

    public function toSearchableArray()
    {
        $record = $this->toArray();

        $record['_geoloc'] = [
            'lat' => $this->orphanage->latitude,
            'lng' => $this->orphanage->longitude,
        ];

        unset(
            $record['created_at'],
            $record['updated_at'],
            $record['deleted_at'],
            $record['name'],
            $record['orphanage_id'],
            $record['additional_info'],
            $record['id'],
        );

        $record['is_adopted'] = $this->is_adopted;
        return $record;
    }
}
