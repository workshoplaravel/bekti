<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kata_dasar extends Model
{
    protected $fillable = ['id_katadasar', 'katadasar', 'tipe_katadasar'];
    public $primaryKey = 'id_katadasar';
    protected $table = 'tb_katadasar';
}
