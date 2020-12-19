<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outlay extends Model
{
    //
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class);

    }
    public function outlayCategory()
    {
        return $this->belongsTo(OutlayCategory::class);

    }//end of outlayCategory
}
