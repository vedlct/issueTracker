<?php

namespace App\Http\Controllers;

use App\BacklogAssignment;
use App\Employee;
use App\User;
use App\Project;
use Session;
use Illuminate\Http\Request;
use App\Backlog;
use Illuminate\Support\Facades\Auth;

class ProjectBacklogManagementController extends Controller
{

    // Get user's company user id
    public function getCompanyUserId(){

        if(Auth::user()->fk_userTypeId == 2)
        {
            $this->user_company_id = Client::where('userId', Auth::user()->userId)->first()->companyId;
        }
        if(Auth::user()->fk_userTypeId == 3 || Auth::user()->fk_userTypeId == 4)
        {
            $this->user_company_id = Auth::user()->fkCompanyId;
        }
//        if(Auth::user()->fk_userTypeId == 4)
//        {
////            $this->user_company_id =Auth::user()->fkCompanyId;
//            $this->user_company_id = Employee::where('employeeUserId', Auth::user()->userId)->first()->fk_companyId;
//        }
        if(Auth::user()->fk_userTypeId == 1)
        {
            $this->user_company_id = null;
        }

        return $this->user_company_id;
    }

    // Backlog Dashboard
    public function dashboard($id){

        $project = Project::findOrFail($id);

        return view('Project.BacklogManagement.mybackloglist')->with('project_id', $id)
                                                                   ->with('project', $project);
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

        $userCompanyId = $this->getCompanyUserId();

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
        $backlog->backlog_details = $r->backlogDetails;
        $backlog->remark = $r->remark;

        // if backlog state change then
        if($r->backlog_state != $backlog->backlog_state)
        {
            $backlog->dev_time = date('Y-m-d H:i:s');
        }

        $backlog->backlog_state = $r->backlog_state;
        $backlog->save();

        Session::flash('message', 'Backlog Updated!');

        return back();
    }

    //
    public function myblacklog(){

        $mybacklogs = Backlog::leftJoin('backlog_assignment', 'backlog_assignment.fk_backlog_id', 'backlog.backlog_id')
                             ->leftJoin('user', 'user.userId', 'backlog_assignment.fk_assigned_employee_user_id')
                             ->leftJoin('project', 'project.projectId', 'backlog.fk_project_id')
                             ->where('user.userId', Auth::user()->userId)
                             ->whereDate('backlog_start_date', '<=', date('Y-m-d'))
                             ->whereDate('backlog_end_date', '>=', date('Y-m-d'))
                             ->where('backlog_state', '!=', 'Complete')
                             ->where('backlog_state', '!=', 'Testing')
                             ->get();

        $mybacklogsMissed = Backlog::leftJoin('backlog_assignment', 'backlog_assignment.fk_backlog_id', 'backlog.backlog_id')
                                   ->leftJoin('user', 'user.userId', 'backlog_assignment.fk_assigned_employee_user_id')
                                   ->leftJoin('project', 'project.projectId', 'backlog.fk_project_id')
                                   ->where('user.userId', Auth::user()->userId)
                                   ->whereDate('backlog_end_date', '<=', date('Y-m-d'))
                                   ->where('backlog_state', '!=', 'Complete')
                                   ->where('backlog_state', '!=', 'Testing')
                                   ->get();

        return view('Project.BacklogManagement.todayWork')->with('mybacklogs', $mybacklogs)
                                                               ->with('mybacklogsMissed', $mybacklogsMissed);
    }
}
