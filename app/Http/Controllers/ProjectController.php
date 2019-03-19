<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Company;
use Auth;
use Session;
use Yajra\DataTables\DataTables;
use App\Status;
use App\Client;
use App\Employee;

class ProjectController extends Controller
{
    // view Project list
    public function index(){
        return view('Project.projectList');
    }

    // get all Company
    public function getAllProject(Request $r){

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
            $projects = Project::select('project.projectName','status.statusData','user.fullName','company.companyName','project.projectId')
                ->Join('company','project.fk_companyId','company.companyId')
                ->Join('user','project.project_createdBy','user.userId')
                ->Join('status','project.projectStatus','status.statusId')
                ->where('project.deleted_at', null);
        }
        else
        {
            $projects = Project::select('project.projectName','status.statusData','user.fullName','company.companyName','project.projectId')
                ->Join('company','project.fk_companyId','company.companyId')
                ->Join('user','project.project_createdBy','user.userId')
                ->Join('status','project.projectStatus','status.statusId')
                ->where('fk_companyId',$userCompanyId)
                ->where('project.deleted_at', null);
        }

        $datatables = Datatables::of($projects);
        return $datatables->make(true);
    }

    // view create project form
    public function create_project(){

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

        if($userCompanyId == null)
        {
            $companylist = Company::all();
        }
        else
        {
            $companylist = Company::where('companyId', $userCompanyId)->get();
        }

        $status = Status::where('statusType', 'project_status')->get();
        return view('Project.projectCreate', ['companylist' => $companylist, 'statusAll' => $status]);
    }

    // insert company
    public function insert_project(Request $r){

        $project = new Project();
        $project->projectName = $r->projectname;
        $project->projectSummary = $r->summary;
        $project->created_at = date('Y-m-d');
        $project->projectDuration = $r->duration;
        $project->projectStatus = $r->status;
        $project->fk_companyId = $r->companyId;
        $project->project_createdBy = Auth::user()->userId;
        $project->save();

        Session::flash('message', 'Project Created!');

        return back();
    }

    // view edit company form
    public function edit_project($id){
        $allStatus = Status::all();
        $project = Project::findOrFail($id);

        // Get user's company ID
        if(Auth::user()->fk_userTypeId == 2)
        {
            $userCompanyId = Client::where('userId', Auth::user()->userId)->first()->companyId;
        }
        if(Auth::user()->fk_userTypeId == 3)
        {
            $userCompanyId = Employee::where('employeeUserId', Auth::user()->userId)->first()->companyId;
        }
        if(Auth::user()->fk_userTypeId == 4)
        {
            $userCompanyId = Employee::where('employeeUserId', Auth::user()->userId)->first()->fk_companyId;
        }
        if(Auth::user()->fk_userTypeId == 1)
        {
            $userCompanyId = null;
        }

        if($userCompanyId == null)
        {
            $companylist = Company::all();
        }
        else
        {
            $companylist = Company::where('companyId', $userCompanyId)->get();
        }

        return view('Project.projectEdit')->with('project', $project)
                                               ->with('companylist', $companylist)
                                               ->with('allStatus', $allStatus);
    }

    // Update company
    public function update_project(Request $r){
        $project = Project::findOrFail($r->id);
        $project->projectName = $r->projectname;
        $project->projectSummary = $r->summary;
        $project->created_at = date('Y-m-d');
        $project->projectDuration = $r->duration;
        $project->projectStatus = $r->status;
        $project->fk_companyId = $r->companyId;
        $project->project_createdBy = Auth::user()->userId;
        $project->save();

        Session::flash('message', 'Project Updated!');

        return back();
    }

    // Project Management
    public function projectmanagement(){
        return view('Project.ProjectManagement.newDashboard');
    }
}
