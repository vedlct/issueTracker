<?php

namespace App\Exports;

use App\Backlog;
use App\BacklogAssignment;
use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;
use App\User;
use DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BacklogExport implements FromView, ShouldAutoSize
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
}
