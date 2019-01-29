<?php

namespace App\Exports;

use App\Ticket;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;
use App\User;

class TicketExport implements FromView
{
    private $data;

    public function __construct($data){
         $this->data=$data;
    }
    public function view(): View
    {
        return view('Ticket.export_ticket', [
            'allTicket' => Ticket::leftJoin('project', 'project.projectId', 'ticket.fk_projectId')
                                    ->leftJoin('user', 'user.userId', 'ticket.ticketAssignPersonUserId')
                                    ->where('ticket.ticketId',$this->data)
                                    ->get(),

            $teamid = Ticket::findOrFail($this->data)->first(),
            $teamMembers = User::Join('assignteam_new','assignteam_new.fk_userId','user.userId')
                ->where('assignteam_new.fkteamId', $teamid->ticketAssignTeamId)->get()
        ]);
    }
}
