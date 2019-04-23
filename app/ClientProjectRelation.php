<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientProjectRelation extends Model
{
    protected $table='client_project_relation';
    protected $primaryKey='id';
    public $timestamps=false;
}
