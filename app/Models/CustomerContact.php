<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerContact extends Model
{
    protected $table = 'customer_contact';



    public function lesson() {
        return $this->belongsTo('App\Models\Customer');
    }
}
