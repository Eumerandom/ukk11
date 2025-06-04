<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'nis',
        'gender',
        'alamat',
        'kontak',
        'email',
        'status_pkl',
    ];

    public function pkls()
    {
        return $this->hasMany(PKL::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updatePKLStatus(): void
    {
        $hasPKL = $this->pkls()->exists();
        $this->status_pkl = $hasPKL ? 'aktif' : 'tidak_aktif';
        $this->saveQuietly();
    }

    public function setNameAttribute($value)
    {
        $this->attributes['nama'] = ucwords(strtolower($value));
    }

}
