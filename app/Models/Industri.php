<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'bidang_usaha',
        'alamat',
        'kontak',
        'email',
        'guru_id',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    public function pkls()
    {
        return $this->hasMany(Siswa::class);
    }
}
