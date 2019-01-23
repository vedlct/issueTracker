<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table='companyemployee';
    protected $primaryKey='companyEmployeeId';
    public $timestamps=false;
}
