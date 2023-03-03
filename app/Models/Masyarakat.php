<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Masyarakat extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // protected $guarded      = [];
    protected $table        = 'masyarakats';
    protected $primaryKey   = 'id';

    protected $fillable = [
        'email','password','telp','nik','nama'
    ];
    // protected $guard_name   = 'masyarakat';
    protected $guard   = 'masyarakat';

    protected $hidden = [
        'passoword'
    ];
}
