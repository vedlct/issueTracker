<?php

namespace App\Http\Controllers;

use App\Backlog;
use Illuminate\Http\Request;
use App\Project;
use App\Company;
use Auth;
use Session;
use Yajra\DataTables\DataTables;
use App\Status;
use App\Client;
use App\Employee;
use App\User;
use Carbon\Carbon;


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

        $inCompletebacklog = Backlog::where('fk_project_id', $id)
                                     ->where('backlog_completion_status', 'Incomplete')
                                     ->get();

        $completebacklog = Backlog::where('fk_project_id', $id)
            ->where('backlog_completion_status', 'Complete')
            ->get();

        return view('Project.ProjectManagement.projectBacklogDashboard')->with('project', $project)
                                                                             ->with('inCompletebacklog', $inCompletebacklog)
                                                                             ->with('completebacklog', $completebacklog)
                                                                             ->with('allEmp', $allEmp);
    }

    // Insert Backlog
    public function insertBacklog(Request $r){
        $backlog = new Backlog();
        $backlog->backlog_title = $r->backlog_title;
        $backlog->fk_project_id = $r->project_id;
        $backlog->backlog_state = 'Backlog';
        $backlog->backlog_start_date = Carbon::parse($r->startdate)->format('Y-m-d h:i:s');
        $backlog->backlog_end_date = Carbon::parse($r->enddate)->format('Y-m-d h:i:s');
        $backlog->backlog_details = $r->backlogDetails;
        $backlog->backlog_priority = $r->priority;
        $backlog->backlog_completion_status = 'Incomplete';
        $backlog->backlog_created_at = date("Y-m-d | h:i:sa");
        $backlog->save();
        Session::flash('message', 'New Backlog Created!');

        return back();
    }

    // Project Management
    public function projectmanagementold(){
        return view('Project.ProjectManagement.dashboard');
    }
}
