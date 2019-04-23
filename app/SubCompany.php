<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCompany extends Model
{
    protected $table ='subCompany';
    protected $primaryKey='subCompanyId';
    public $timestamps = false;
}
