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

protected $table            = 'petugas';
    protected $primaryKey   = 'id_petugas';
    // protected $guarded      = [];
    protected $fillable     = [
        'nama_petugas','level','email','password','telp','add_by','edit_by'
    ];
    // protected $guard_name   = 'admin';
    protected $guard   = 'admin';

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function PetugasAddBy()
    {
        return $this->belongsTo(Petugas::class,'add_by', 'id_petugas');
    }

    public function PetugasEditBy()
    {
        return $this->belongsTo(Petugas::class, 'edit_by','id_petugas');
    }

}
