<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    //
    use softDeletes;
    protected $fillable = ['business_name', 'business_description', 'deleted_at','active', 'static_ip_adress', 'adress', 'created_at', 'updated_at'];  

}
