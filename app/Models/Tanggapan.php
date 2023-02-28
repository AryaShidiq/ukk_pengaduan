<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;
    protected $guarded  = [];
    protected $table    = 'tanggapans';

    public function getPengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'id_pengaduan', 'id_pengaduan');
    }

    public function getPetugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas','id_petugas');
    }
}
