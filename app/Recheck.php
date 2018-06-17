<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recheck extends Model
{
    protected $fillable = ['dictionary_id', 'stemming_id', 'total'];
    protected $primaryKey = 'dictionary_id';

    public function dictionary()
    {
        return $this->belongsTo(Dictionary::class);
    }
}
