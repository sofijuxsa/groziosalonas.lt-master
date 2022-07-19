<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceArtist extends Model
{
    use HasFactory;

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }

    public function artist()
    {
        return $this->hasOne(Artist::class, 'id', 'artist_id');
    }
}
