<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stufe extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'hls.stufe';
    protected $primaryKey = 'id_stufe';

    protected $fillable = ['stufe'];
}
