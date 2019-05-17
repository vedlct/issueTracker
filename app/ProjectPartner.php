<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectPartner extends Model
{
    //
    protected $table='project_partner';
    protected $primaryKey='projectPartnerId';
    public $timestamps=false;
}
