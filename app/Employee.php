<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $fillable = [
        'full_name',
        'gender',
        'birth_date',
        'hire_date',

    ];



    //
    protected $guarded = [];

    public function salary()
    {
        return $this->hasOne(Salary::class);
    }
}
