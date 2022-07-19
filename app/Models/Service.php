<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'service_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Service::class,'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Service::class, 'parent_id');
    }

    public function serviceArtist()
    {
        return $this->hasMany(ServiceArtist::class, 'service_id', 'id');
    }
}
