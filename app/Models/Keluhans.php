<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Keluhans extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'id_card',
        'tanggal',
        'isi',
        'tanggapan'
    ];
}
