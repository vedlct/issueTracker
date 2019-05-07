<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JoinRequest extends Model
{
    protected $table = 'joinRequest';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
