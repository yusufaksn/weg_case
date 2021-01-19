<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerInformation extends Model
{
   protected $table = 'customer_information';


    protected $fillable = [
        'name','gender', 'date_birth', 'place_birth','martial_status_id','tc_serial_number','job'
    ];
}
