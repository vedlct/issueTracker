<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Backlog extends Model
{
    protected $table='backlog';
    protected $primaryKey='backlog_id';
    public $timestamps=false;
}
