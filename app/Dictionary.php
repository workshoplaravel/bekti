<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    protected $fillable = ['word'];

    public function recheck()
    {
        return $this->hasMany(Recheck::class);
    }
}
