<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\UserTrait;


class Artist extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;
    use Notifiable;

    protected $table = 'artists';
    protected $fillable = ['name', 'last_name', 'email', 'password', 'phone_number'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'artist_id', 'id');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'artist_id', 'id');
    }

    public function serviceArtist()
    {
        return $this->hasMany(ServiceArtist::class, 'artist_id', 'id');
    }
}
