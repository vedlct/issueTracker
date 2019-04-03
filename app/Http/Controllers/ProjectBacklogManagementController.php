<?php

namespace App\Http\Controllers;

use App\BacklogAssignment;
use App\Employee;
use App\User;
use Session;
use Illuminate\Http\Request;
use App\Backlog;
use Illuminate\Support\Facades\Auth;

class ProjectBacklogManagementController extends Controller
{
    // Backlog Dashboard
    public function dashboard($id){
        return view('Project.BacklogManagement.mybackloglist')->with('project_id', $id);
    }

    // get all Backlog
    public function getAllBacklog(Request $r){

        $project_all_backlogs = Backlog::where('fk_project_id', $r->project_id)
                                        ->orderBy('backlog.backlog_id','desc' )
                                        ->get();


        // select backlog assigned employee list
        $backlog = BacklogAssignment::leftJoin('backlog', 'backlog.backlog_id', 'backlog_assignment.fk_backlog_id')
            ->where('backlog.fk_project_id', $r->project_id)->get();

        $array = array();
        foreach ($backlog as $emp)
        {
            array_push($array, $emp->fk_assigned_employee_user_id);
        }
        $backlogassignedEmp = User::leftJoin('backlog_assignment', 'backlog_assignment.fk_assigned_employee_user_id', 'user.userId')
            ->whereIn('user.userId', $array)
            ->get();


        return view('Project.BacklogManagement.getAllBacklog')
                ->with('backlogs', $project_all_backlogs)
                ->with('backlogassignedEmp', $backlogassignedEmp);
    }

    // Backlog Details
    public function backlogDetails(Request $r){


        // Get user's company ID
        if(Auth::user()->fk_userTypeId == 2)
        {
            $userCompanyId = Client::where('userId', Auth::user()->userId)->first()->companyId;
        }
        if(Auth::user()->fk_userTypeId == 3)
        {
            $userCompanyId = Employee::where('employeeUserId', Auth::user()->userId)->first()->fk_companyId;
        }
        if(Auth::user()->fk_userTypeId == 4)
        {
            $userCompanyId = Employee::where('employeeUserId', Auth::user()->userId)->first()->fk_companyId;
        }
        if(Auth::user()->fk_userTypeId == 1)
        {
            $userCompanyId = null;
        }

        // get employee list
        if($userCompanyId == null)
        {
            $allEmp = User::where('fk_userTypeId', 3)->get();
        }
        else
        {
            $allEmp = User::leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')
                ->where('companyemployee.fk_companyId',$userCompanyId)
                ->where('user.fk_userTypeId', 3)
                ->get();
        }


        $backlogAssignedEmp = BacklogAssignment::where('fk_backlog_id', $r->backlog_id)->get();


        $backlog = Backlog::findOrFail($r->backlog_id);

        return view('Project.BacklogManagement.backlog_single')->with('backlog', $backlog)
                                                                    ->with('backlogAssignedEmp', $backlogAssignedEmp)
                                                                    ->with('allEmp', $allEmp);;
    }


    public function updateBacklogDetails(Request $r){
        $backlog = Backlog::findOrFail($r->backlog_id);
        $backlog->backlog_state = $r->backlog_state;
        $backlog->save();

        Session::flash('message', 'Backlog Updated!');

        return back();
    }
}
