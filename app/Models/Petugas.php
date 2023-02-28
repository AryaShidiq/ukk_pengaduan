<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\Admin as Authenticatable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Petugas extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table        = 'petugas';
    protected $primary      = 'id_petugas';
    // protected $guarded      = [];
    protected $fillable     = [
        'nama_petugas','level','email','password','telp'
    ];
    // protected $guard_name   = 'admin';
    protected $guard   = 'admin';

    protected $hidden = [
        'password'
    ];
}
