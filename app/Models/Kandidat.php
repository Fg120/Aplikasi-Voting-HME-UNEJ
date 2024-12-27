<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandidat extends Model
{
    use HasFactory;

    // protected $table = 'kandidats_empty';
    protected $fillable = ['nomor', 'nim', 'nama', 'angkatan', 'visi', 'misi', 'foto'];
}
