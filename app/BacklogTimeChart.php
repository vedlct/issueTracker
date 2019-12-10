<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BacklogTimeChart extends Model
{
    protected $table='backlog_time_chart';
    protected $primaryKey='time_chart_id';
    public $timestamps=false;

    protected $casts = [
        'date'  => 'date:Y-m-d'
    ];
}
