<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $table='ticketreply';
    protected $primaryKey='ticketReplyId';
    public $timestamps=false;
}
