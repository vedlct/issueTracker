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

class ProjectController extends Controller
{
    // view Project list
    public function index(){
        return view('Project.projectList');
    }

    // get all Company
    public function getAllProject(Request $r){

        $projects = Project::select('project.projectName','status.statusData','user.fullName','company.companyName','project.projectId')
                                ->Join('company','project.fk_companyId','company.companyId')
                                ->Join('user','project.project_createdBy','user.userId')
                                ->Join('status','project.projectStatus','status.statusId')
                                ->where('project.deleted_at', null)->get();
        $datatables = Datatables::of($projects);
        return $datatables->make(true);
    }

    // view create project form
    public function create_project(){
        $companylist = Company::all();
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
        $companylist = Company::all();
        $allStatus = Status::all();
        $project = Project::findOrFail($id);

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
}
