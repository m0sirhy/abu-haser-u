<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsumptionCycle extends Model
{
    //
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function getFCurentAttribute()
    {
        if ($this->curent > 0) {
            $fcurent = $this->curent;

            return $fcurent  ;
        }
    }
    public function getConsumeAttribute()
    {
        if ($this->curent > 0) {
            $consume = $this->curent - $this->previous;
            $fcurent = $this->curent;

            return $consume  ;
        }
    } //end of get profit attribute

   
}