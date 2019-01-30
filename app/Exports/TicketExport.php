<?php

namespace App\Exports;

use App\Ticket;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;
use App\User;
use DB;
class TicketExport implements FromView
{
    private $data;

    public function __construct($data){
         $this->data=$data;
    }
    public function view(): View
    {
        return view('Ticket.export_ticket', [

            'allTicket' =>  Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"),'ticket.*','createdUser.fullName as createdFullName','assignUser.fullName as assignFullName', 'project.*')
                ->leftJoin('project','project.projectId','ticket.fk_projectId')
                ->leftJoin('user as createdUser','createdUser.userId','ticket.fk_ticketOpenerId')
                ->leftJoin('user as assignUser','assignUser.userId','ticket.ticketAssignPersonUserId')
                ->leftJoin('assignteam_new','assignteam_new.fkteamId','ticket.ticketAssignTeamId')
                ->leftJoin('user','user.userId','assignteam_new.fk_userId')
                ->whereIn('ticketId', $this->data->allCheckedTicket)
                ->groupBy('ticket.ticketId')
                ->get(),
        ]);
    }
}
