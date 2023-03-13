<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table    = 'categories';
    protected $guarded  = [''];

    public function addBy()
    {
        return $this->belongsTo(Petugas::class, 'add_by','id_petugas');
    }

    public function editBy()
    {
        return $this->belongsTo(Petugas::class, 'edit_by','id_petugas');
    }
}
