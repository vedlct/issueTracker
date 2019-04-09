<?php

namespace App\Http\Controllers;

use App\Backlog;
use App\Exports\BacklogExport;
use Illuminate\Http\Request;
use App\Project;
use App\Company;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use Yajra\DataTables\DataTables;
use App\Status;
use App\Client;
use App\Employee;
use App\User;
use Carbon\Carbon;
use App\BacklogAssignment;
use App\BacklogComment;


class ProjectManagementController extends Controller
{

    // Project Management Dashboard
    public function projectmanagementDashboard(){

        $allStatus = Status::where('statusType', 'project_status')->get();

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

        // get all project of user's company
        if($userCompanyId == null)
        {
            $projects = Project::select('project.project_name','status.statusData','user.fullName','company.companyName','project.projectId', 'project.project_status')
                ->Join('company','project.fk_company_id','company.companyId')
                ->Join('user','project.project_created_by','user.userId')
                ->Join('status','project.project_status','status.statusId')
                ->where('project.project_deleted_at', null)
                ->get();
        }
        else
        {
            $projects = Project::select('project.project_name','status.statusData','user.fullName','company.companyName','project.projectId', 'project.project_status')
                ->Join('company','project.fk_company_id','company.companyId')
                ->Join('user','project.project_created_by','user.userId')
                ->Join('status','project.project_status','status.statusId')
                ->where('fk_company_id',$userCompanyId)
                ->where('project.project_deleted_at', null)
                ->get();
        }

        return view('Project.ProjectManagement.projectList')->with('projects', $projects)
                                                                 ->with('allStatus', $allStatus);
    }


    // Project Backlog Dashboard
    public function projectmanagement($id){

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

        $project = Project::findOrFail($id);

        $inCompletebacklog = Backlog::leftJoin('backlog_assignment', 'backlog_assignment.fk_backlog_id', 'backlog.backlog_id')
                                     ->where('fk_project_id', $id)
                                     ->where('backlog_completion_status', 'Incomplete')
                                     ->groupBy('backlog.backlog_id')
                                     ->orderBy('backlog.backlog_id','desc' )
                                     ->get();


        // select backlog assigned employee list
        $backlog = BacklogAssignment::leftJoin('backlog', 'backlog.backlog_id', 'backlog_assignment.fk_backlog_id')
                                    ->where('backlog.fk_project_id', $id)->get();

        $array = array();
        foreach ($backlog as $emp)
        {
            array_push($array, $emp->fk_assigned_employee_user_id);
        }


        $backlogassignedEmp = User::leftJoin('backlog_assignment', 'backlog_assignment.fk_assigned_employee_user_id', 'user.userId')
                                    ->whereIn('user.userId', $array)
                                    ->get();


        $completebacklog = Backlog::where('fk_project_id', $id)
            ->where('backlog_completion_status', 'Completed')
            ->orderBy('backlog.backlog_id','desc' )
            ->get();

        return view('Project.ProjectManagement.projectBacklogDashboard')->with('project', $project)
                                                                             ->with('inCompletebacklogs', $inCompletebacklog)
                                                                             ->with('completebacklogs', $completebacklog)
                                                                             ->with('backlogassignedEmp', $backlogassignedEmp)
                                                                             ->with('allEmp', $allEmp);
    }

    // Insert Backlog
    public function insertBacklog(Request $r){
        $backlog = new Backlog();
        $backlog->backlog_title = $r->backlog_title;
        $backlog->fk_project_id = $r->project_id;
        $backlog->backlog_time = $r->backlog_time;
        $backlog->backlog_state = 'Backlog';
        $backlog->backlog_start_date = Carbon::parse($r->startdate)->format('Y-m-d h:i:s');
        $backlog->backlog_end_date = Carbon::parse($r->enddate)->format('Y-m-d h:i:s');
        $backlog->backlog_details = $r->backlogDetails;
        $backlog->backlog_priority = $r->priority;
        $backlog->backlog_completion_status = 'Incomplete';
        $backlog->backlog_created_at = date('Y-m-d H:i:s');
        $backlog->save();

        if($r->assigned_employee)
        {
            foreach ($r->assigned_employee as $emp){
                $assignment = new BacklogAssignment();
                $assignment->fk_backlog_id = $backlog->backlog_id;
                $assignment->fk_assigned_employee_user_id = $emp;
                $assignment->backlog_assignment_created_at = date('Y-m-d H:i:s');
                $assignment->save();
            }
        }

        Session::flash('message', 'New Backlog Created!');

        return back();
    }

    // Project Management
    public function returnEditBacklog(Request $r){


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


        $backlog = Backlog::findOrFail($r->backlog_id);


        $backlogAssignedEmp = BacklogAssignment::where('fk_backlog_id', $r->backlog_id)->get();

        return view('Project.ProjectManagement.updateBacklog')->with('backlog', $backlog)
                                                                   ->with('backlogAssignedEmp', $backlogAssignedEmp)
                                                                   ->with('allEmp', $allEmp);
    }

    public function updateBacklog(Request $r){
        $backlog = Backlog::findOrFail($r->backlog_id);
        $backlog->backlog_title = $r->backlog_title;
        $backlog->backlog_time = $r->backlog_time;
        $backlog->backlog_start_date = Carbon::parse($r->startdate)->format('Y-m-d h:i:s');
        $backlog->backlog_end_date = Carbon::parse($r->enddate)->format('Y-m-d h:i:s');
        $backlog->backlog_details = $r->backlogDetails;
        $backlog->backlog_priority = $r->priority;

        $backlog->save();

        BacklogAssignment::where('fk_backlog_id', $r->backlog_id)->delete();

        if($r->assigned_employee)
        {
            if($r->assigned_employee)
            {
                foreach ($r->assigned_employee as $emp){
                    $assignment = new BacklogAssignment();
                    $assignment->fk_backlog_id = $backlog->backlog_id;
                    $assignment->fk_assigned_employee_user_id = $emp;
                    $assignment->backlog_assignment_created_at = date('Y-m-d H:i:s');
                    $assignment->save();
                }
            }
        }

        Session::flash('message', 'Backlog Updated!');

        return back();
    }

    // Post Comment
    public function postComment(Request $r){
        $comment = new BacklogComment();
        $comment->fk_comment_user_id = $r->user_id;
        $comment->fk_backlog_id = $r->backlog_id;
        $comment->comment = $r->comment;
        $comment->comment_created_at = date('Y-m-d H:i:s');
        $comment->save();
        return back();
    }

    // get Comments
    public function getComments(Request $r){
        $backlogComments = BacklogComment::leftJoin('user', 'user.userId', 'backlog_comment.fk_comment_user_id')->where('fk_backlog_id', $r->backlog_id)->get();
        return view('Project.ProjectManagement.getAllComments')->with('comments', $backlogComments);
    }


    // Generate Report
    public function generateReport(Request $r){
        Excel::store(new BacklogExport($r), 'project_backlog.xlsx');
    }

}
