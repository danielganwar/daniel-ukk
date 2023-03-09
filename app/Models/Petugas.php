<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;
    protected $table = "petugas";
    protected $fillable = [
        'id_petugas',
        'username',
        'password',
        'nama_petugas',
        'level'
    ];
}
