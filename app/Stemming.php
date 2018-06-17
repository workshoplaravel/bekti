<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stemming extends Model
{
    protected $fillable = ['kalimat', 'q_a_id'];
}
