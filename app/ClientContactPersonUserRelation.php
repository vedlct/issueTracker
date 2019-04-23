<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientContactPersonUserRelation extends Model
{
    protected $table='clientContactPerson_user_relation';
    protected $primaryKey='relationId';
    public $timestamps=false;
}
