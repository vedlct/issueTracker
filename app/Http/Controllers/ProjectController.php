<?php

namespace App\Http\Controllers;

use App\Backlog;
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

    // Get user's company user id
    public function getCompanyUserId(){

        if(Auth::user()->fk_userTypeId == 2)
        {
            $this->user_company_id = Client::where('userId', Auth::user()->userId)->first()->companyId;
        }
        if(Auth::user()->fk_userTypeId == 3)
        {
            $this->user_company_id = Employee::where('employeeUserId', Auth::user()->userId)->first()->fk_companyId;
        }
        if(Auth::user()->fk_userTypeId == 4)
        {
            $this->user_company_id = Employee::where('employeeUserId', Auth::user()->userId)->first()->fk_companyId;
        }
        if(Auth::user()->fk_userTypeId == 1)
        {
            $this->user_company_id = null;
        }

        return $this->user_company_id;
    }

    // view Project list
    public function index(){

        $userCompany = $this->getCompanyUserId();

        // catculate project percentage
        $projects = Project::where('fk_company_id', $userCompany)->get();
        $percentage_all = array();

        foreach ($projects as $project){
            $completedBacklog = Backlog::where('fk_project_id', $project->projectId)->where('backlog_state', 'complete')->count();
            $totalBacklog = Backlog::where('fk_project_id', $project->projectId)->count();;
            $percentage = ($completedBacklog*100)/$totalBacklog;
            $percentage_all[$project->projectId] = round($percentage);
        }

        return view('Project.projectList')->with('project_percentage', $percentage_all);
    }

    public function test(){

        return view('test');
    }

    // get all Company
    public function getAllProject(Request $r){

        $userCompanyId = $this->getCompanyUserId();

        // get all project of user's company
        if($userCompanyId == null)
        {
            $projects = Project::select('project.project_name','status.statusData','user.fullName','company.companyName','project.projectId')
                ->Join('company','project.fk_company_id','company.companyId')
                ->Join('user','project.project_created_by','user.userId')
                ->Join('status','project.project_status','status.statusId')
                ->where('project.project_deleted_at', null);
        }
        else
        {
            $projects = Project::select('project.project_name','status.statusData','user.fullName','company.companyName','project.projectId')
                ->Join('company','project.fk_company_id','company.companyId')
                ->Join('user','project.project_created_by','user.userId')
                ->Join('status','project.project_status','status.statusId')
                ->where('fk_company_id',$userCompanyId)
                ->where('project.project_deleted_at', null);
        }

        $datatables = Datatables::of($projects);
        return $datatables->make(true);
    }

    // view create project form
    public function create_project(){

        $userCompanyId = $this->getCompanyUserId();

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
        $project->project_name = $r->projectname;
        $project->fk_company_id = $r->companyId;
        $project->project_status = $r->status;
        $project->project_start_date = $r->projectStartDate;
        $project->project_summary = $r->summary;
        $project->project_duration = $r->duration;
        $project->project_created_by = Auth::user()->userId;
        $project->project_created_at = date("Y-m-d H:i:s");
        $project->save();

        Session::flash('message', 'Project Created!');

        return back();
    }

    // view edit company form
    public function edit_project($id){
        $allStatus = Status::where('statusType', 'project_status')->get();
        $project = Project::findOrFail($id);

        $userCompanyId = $this->getCompanyUserId();

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
        $project->project_name = $r->projectname;
        $project->fk_company_id = $r->companyId;
        $project->project_status = $r->status;
        $project->project_start_date = $r->projectStartDate;
        $project->project_summary = $r->summary;
        $project->project_duration = $r->duration;
        $project->save();

        Session::flash('message', 'Project Updated!');

        return back();
    }


}
