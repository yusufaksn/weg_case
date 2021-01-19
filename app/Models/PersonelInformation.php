<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonelInformation extends Model
{
    protected $table = 'personel_information';

    protected $fillable = ['id','tc_no','blood_group_id','date_birth'];
}
