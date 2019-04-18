<?php

namespace App\Exports;

use App\Ticket;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;
use App\User;
use DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class TicketExport implements FromView, ShouldAutoSize, WithHeadings, WithEvents
{
    private $data;

    public function __construct($data){
         $this->data = $data;
    }
    public function view(): View
    {
        return view('Ticket.export_ticket', [

            'allTicket' =>  Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"),'ticket.*','createdUser.fullName as createdFullName','assignUser.fullName as assignFullName', 'project.project_name')
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

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

                $event->sheet->getStyle('A1:W100')
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.

    }
}
