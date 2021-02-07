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

            return $fcurent;
        }
    }
    public function getConsumeAttribute()
    {


        if ($this->curent >= 0) {
            $consume = $this->curent - $this->previous;
            if ($consume > 0)
                return $consume;

            return 0;
        }


    }
public function getDateAttribute(){
   $date= \Carbon\Carbon::parse($this->updated_at )->diffForHumans();
    return $date;
    
}



}
