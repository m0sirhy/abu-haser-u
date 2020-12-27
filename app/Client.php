<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //

    protected $guarded = [];

    public function consume()
    {
        return $this->hasMany('App\Consume');
    }
}
