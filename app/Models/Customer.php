<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';


    public  function customerContact() {
        return $this->hasMany('App\Models\CustomerContact');
    }
    public  function customerInformation() {
        return $this->hasMany('App\Models\CustomerInformation');
    }
}
