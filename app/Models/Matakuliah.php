<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;
    protected $primaryKey = 'kode';
    protected $table = 'matakuliah';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'kode',
        'nama_matakuliah',
        'jadwal',
        'daya_tampung',
        'id_dosen'
    ];
    public function dosen(){
        return $this->belongsTo(Dosen::class,'id_dosen');
    }

    public function mahasiswa() {
        return $this->belongsToMany(mahasiswa::class, 'matakuliah_mahasiswa', 'id_mahasiswa', "id_matakuliah");
    }
}
