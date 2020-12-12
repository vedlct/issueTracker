<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table='project';
    protected $primaryKey='projectId';
    public $timestamp=false;
}
