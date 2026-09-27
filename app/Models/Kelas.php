<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasMany(UserModel::class, 'kelas_id');
    }

    public function mataKuliah()
    {
        return $this->belongsToMany(MataKuliah::class, 'kelas_mata_kuliah', 'kelas_id', 'mata_kuliah_id');
    }

    public function getKelas(){
        return $this->all();
    }
}
