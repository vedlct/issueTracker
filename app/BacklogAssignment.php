<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BacklogAssignment extends Model
{
    protected $table='backlog_assignment';
    protected $primaryKey='backlog_assignment_id';
    public $timestamps=false;
}
