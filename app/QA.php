<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QA extends Model
{
    protected $table = 'q_as';
    protected $fillable = [
        'question', 
        'answer_1', 
        'rate_1',
        'answer_2', 
        'rate_2',
        'answer_3', 
        'rate_3',
        'answer_4', 
        'rate_4',
        'answer_5', 
        'rate_5'
    ];

    public function stemming()
    {
        return $this->hasOne(Stemming::class, 'q_a_id');
    }
}
