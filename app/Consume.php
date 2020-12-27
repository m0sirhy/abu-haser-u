<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consume extends Model
{
    //
    protected $guarded = [];


    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
