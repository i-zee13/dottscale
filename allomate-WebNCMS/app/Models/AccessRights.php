<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 

class AccessRights extends Model  
{ 
    protected $guarded = [];
    protected $table = "access_rights";
    public $timestamps = false;
}
