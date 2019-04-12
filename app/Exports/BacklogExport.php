<?php

namespace App\Exports;

use App\Backlog;
use App\BacklogAssignment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class BacklogExport implements FromView, ShouldAutoSize, WithHeadings, WithEvents
{

    private $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function view(): View
    {

        return view('Project.ProjectManagement.project_excel', [

            // all feature
            'backlogs' => Backlog::where('fk_project_id', $this->data->project_id)
                                 ->get(),

            // backlog assigned employee list
            'backlog_assigned_emp' => BacklogAssignment::leftJoin('backlog', 'backlog.backlog_id', 'backlog_assignment.fk_backlog_id')
                                                       ->leftJoin('user', 'user.userId', 'backlog_assignment.fk_assigned_employee_user_id')
                                                       ->where('backlog.fk_project_id', $this->data->project_id)
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

//                $event->sheet->getStyle('A1:W1')
//                    ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            },
        ];
    }


    public function headings(): array
    {
        // TODO: Implement headings() method.

    }
}
