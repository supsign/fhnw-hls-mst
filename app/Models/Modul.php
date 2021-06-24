<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'hls.modul';
    protected $primaryKey = 'laufnummer';
}
