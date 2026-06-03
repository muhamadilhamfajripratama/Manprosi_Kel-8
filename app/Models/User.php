<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'password',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function lahan()
    {
        return $this->hasMany(Lahan::class, 'petani_id');
    }

    public function batchTanam()
    {
        return $this->hasMany(BatchTanam::class, 'petani_id');
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class);
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'distributor_id');
    }
}
