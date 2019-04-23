<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BacklogComment extends Model
{
    protected $table='backlog_comment';
    protected $primaryKey='backlog_comment_id';
    public $timestamps=false;
}
