<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    //
    protected $table ='usertype';
    protected $primaryKey='userTypeId';
    public $timestamps = false;
}
