<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutlayCategory extends Model
{
    //
    protected $guarded = [];

    
    public function outlays()
    {
        return $this->hasMany(Outlay::class);

    }//end of outlays
}
