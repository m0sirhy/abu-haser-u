<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $guarded = [];

    public function salary()
    {
        return $this->hasOne(Salary::class);
    }
}
