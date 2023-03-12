<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $guarded      = [''];
    protected $table        = 'pengaduans';
    protected $primaryKey   = 'id_pengaduan';

    public function getKategori()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getCitizen()
    {
        return $this->belongsTo(Masyarakat::class, 'nik','nik');
    }
}
