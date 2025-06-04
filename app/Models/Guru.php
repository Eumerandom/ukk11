<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'gender',
        'alamat',
        'kontak',
        'email',
    ];

    public function industris()
    {
        return $this->hasMany(Industri::class);
    }
    public function pkls()
    {
        return $this->hasMany(Siswa::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
