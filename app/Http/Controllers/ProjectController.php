<?php

namespace App\Http\Controllers;

use App\Backlog;
use App\ClientContactPersonUserRelation;
use App\ClientProjectRelation;
use App\User;
use Carbon\Carbon;
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
            $this->user_company_id = ClientContactPersonUserRelation::where('person_userId', Auth::user()->userId)->first()->clientId;
        }
        if(Auth::user()->fk_userTypeId == 3)
        {
            $this->user_company_id = Auth::user()->fkCompanyId;
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

        // Calculate project percentage
        if($userCompany == null)
        {
            $projects = Project::all();
        }
        else
        {
            if(Auth::user()->fk_userTypeId == 4 || Auth::user()->fk_userTypeId == 3)
            {
                $projects = Project::where('fk_company_id', $userCompany)->get();
            }
            else
            {
                $projects = Project::where('fk_client_id', $userCompany)->get();
            }
        }

        $percentage_all = array();

        foreach ($projects as $project)
        {
            $completedBacklog = Backlog::where('fk_project_id', $project->projectId)
                                    ->where('backlog_state', 'complete')
                                    ->count();

            $totalBacklog = Backlog::where('fk_project_id', $project->projectId)->count();
            if($totalBacklog == 0)
            {
                $percentage = 0;
            }
            else
            {
                $percentage = ($completedBacklog*100)/$totalBacklog;
            }
            $percentage_all[$project->projectId] = round($percentage);
        }

        return view('Project.projectList')->with('project_percentage', $percentage_all);
    }

    public function test(){

        return view('test');
    }


    public function getAllProject(Request $r)
    {
        $userCompanyId = $this->getCompanyUserId();

        // GET ALL PROJECTS OF USERS COMPANY
        if($userCompanyId == null)
        {
            $projects = Project::select('project.project_name','status.statusData','user.fullName','company.companyName','project.projectId', 'project.project_type', 'client.clientName')
                               ->Join('company','project.fk_company_id','company.companyId')
                               ->Join('user','project.project_created_by','user.userId')
                               ->Join('status','project.project_status','status.statusId')
                               ->leftjoin('client', 'project.fk_client_id', 'client.clientId')
                               ->where('project.project_status', '!=' ,6)
                               ->where('project.project_deleted_at', null);
        }
        else
        {
            if(Auth::user()->fk_userTypeId == 4 || Auth::user()->fk_userTypeId == 3)
            {
                $projects = Project::select('project.project_name','status.statusData','user.fullName','company.companyName','project.projectId', 'project.project_type', 'client.clientName')
                                   ->leftJoin('company','project.fk_company_id','company.companyId')
                                   ->leftJoin('user','project.project_created_by','user.userId')
                                   ->leftJoin('status','project.project_status','status.statusId')
                                   ->leftjoin('client', 'project.fk_client_id', 'client.clientId')
                                   ->where('project.project_status', '!=' ,6)
                                   ->where('fk_company_id',$userCompanyId);
            }
            else
            {
                // client
                $projects = Project::select('project.project_name','status.statusData','user.fullName','company.companyName','project.projectId', 'project.project_type', 'client.clientName')
                                   ->leftJoin('company','project.fk_company_id','company.companyId')
                                   ->leftJoin('user','project.project_created_by','user.userId')
                                   ->leftjoin('client', 'project.fk_client_id', 'client.clientId')
                                   ->leftJoin('status','project.project_status','status.statusId')
                                   ->where('project.project_status', '!=' ,6)
                                   ->where('fk_client_id', $this->getCompanyUserId());

//                if(Auth::user()->fk_userTypeId == 2)
//                {
////                    $clientId = Client::where('userId', Auth::user()->userId)->first()->clientId;
////
////                    $projects=$projects->leftJoin('client_project_relation', 'client_project_relation.projectId', 'project.projectId')
////                                       ->where('client_project_relation.clientId', $clientId);
//                }

                $projects = $projects->where('project.project_deleted_at', null);
            }
        }

        $datatables = Datatables::of($projects);
        return $datatables->make(true);

    }

    // project for issue
    public function getAllProject2(Request $r)
    {
        $userCompanyId = $this->getCompanyUserId();

        // GET ALL PROJECTS OF USERS COMPANY
        if($userCompanyId == null)
        {
            $projects = Project::select('project.project_name','status.statusData','user.fullName','company.companyName','project.projectId', 'project.project_type', 'client.clientName')
                ->Join('company','project.fk_company_id','company.companyId')
                ->Join('user','project.project_created_by','user.userId')
                ->Join('status','project.project_status','status.statusId')
                ->leftjoin('client', 'project.fk_client_id', 'client.clientId')
                ->where('project.project_status', 6)
                ->where('project.project_deleted_at', null);
        }
        else
        {
            if(Auth::user()->fk_userTypeId == 4 || Auth::user()->fk_userTypeId == 3)
            {
                $projects = Project::select('project.project_name','status.statusData','user.fullName','company.companyName','project.projectId', 'project.project_type', 'client.clientName')
                    ->leftJoin('company','project.fk_company_id','company.companyId')
                    ->leftJoin('user','project.project_created_by','user.userId')
                    ->leftJoin('status','project.project_status','status.statusId')
                    ->leftjoin('client', 'project.fk_client_id', 'client.clientId')
                    ->where('project.project_status', 6)
                    ->where('fk_company_id',$userCompanyId);
            }
            else
            {
                $projects = Project::select('project.project_name','status.statusData','user.fullName','company.companyName','project.projectId', 'project.project_type', 'client.clientName')
                    ->leftJoin('company','project.fk_company_id','company.companyId')
                    ->leftJoin('user','project.project_created_by','user.userId')
                    ->leftjoin('client', 'project.fk_client_id', 'client.clientId')
                    ->leftJoin('status','project.project_status','status.statusId')
                    ->where('project.project_status', 6);

                $projects = $projects->where('project.project_deleted_at', null);
            }
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

        $array1 = array();
        foreach ($companylist as $c)
        {
            array_push($array1, $c->companyId);
        }

        $clients = Client::where('clientCompanyId', $this->getCompanyUserId())
                         ->where('deleted_at', null)
                         ->get();

        $status = Status::where('statusType', 'project_status')->get();

        return view('Project.projectCreate', ['companylist' => $companylist, 'statusAll' => $status,'clients'=>$clients]);
    }


    // insert company
    public function insert_project(Request $r){

        $project = new Project();
        $project->project_name = $r->projectname;
        if($r->projectType == "Company Personal")
        {
            $project->fk_company_id = $this->getCompanyUserId();
        }
        else
        {
            $project->fk_client_id = $r->client;
            $project->fk_company_id = $this->getCompanyUserId();
        }
        $project->project_type = $r->projectType;
        $project->project_status = $r->status;
        $project->project_start_date = Carbon::parse($r->projectStartDate)->format('Y-m-d');
        $project->project_summary = $r->summary;
        $project->project_duration = $r->duration;
        $project->project_created_by = Auth::user()->userId;
        $project->project_created_at = date("Y-m-d H:i:s");
        $project->save();

//        if($r->contactPersonList){
//            foreach ($r->contactPersonList as $client){
//                $relation = new ClientProjectRelation();
//                $relation->clientId = $client;
//                $relation->projectId = $project->projectId;
//                $relation->assignBy = Auth::user()->userId;
//                $relation->save();
//            }
//        }

        Session::flash('message', 'Project Created!');

        return back();
    }

    // view edit company form
    public function edit_project($id){

        $allStatus = Status::where('statusType', 'project_status')->get();
        $project = Project::findOrFail($id);

        $userCompanyId = $this->getCompanyUserId();

//        if($userCompanyId == null)
//        {
//            $companylist = Company::all();
//        }
//        else
//        {
//            $companylist = Company::where('companyId', $userCompanyId)->get();
//        }
//
//        $array1 = array();
//        foreach ($companylist as $c)
//        {
//            array_push($array1, $c->companyId);
//        }
//
        $clients = Client::where('clientCompanyId',$this->getCompanyUserId())->get();

        return view('Project.projectEdit')->with('project', $project)
//                                               ->with('companylist', $companylist)
                                               ->with('clients', $clients)
//                                               ->with('assignedClients', $assignedClients)
                                               ->with('statusAll', $allStatus);
    }

    // Update company
    public function update_project(Request $r){
//        $project = Project::findOrFail($r->id);
//        $project->project_name = $r->projectname;
//        $project->fk_company_id = $r->companyId;
//        $project->project_status = $r->status;
//        $project->project_start_date = $r->projectStartDate;
//        $project->project_summary = $r->summary;
//        $project->project_duration = $r->duration;
//        $project->save();
//
//        ClientProjectRelation::where('projectId',$project->projectId)->delete();
//        if($r->clientList){
//            foreach ($r->clientList as $client){
//                $relation=new ClientProjectRelation();
//                $relation->clientId=$client;
//                $relation->projectId=$project->projectId;
//                $relation->assignBy=Auth::user()->userId;
//                $relation->save();
//
//            }
//        }


        $project = Project::findOrFail($r->id);
        $project->project_name = $r->projectname;
        if($r->projectType == "Company Personal")
        {
            $project->fk_company_id = $this->getCompanyUserId();
        }
        else
        {
            $project->fk_client_id = $r->client;
            $project->fk_company_id = $this->getCompanyUserId();
        }
        $project->project_type = $r->projectType;
        $project->project_status = $r->status;
        $project->project_start_date = Carbon::parse($r->projectStartDate)->format('Y-m-d');
        $project->project_summary = $r->summary;
        $project->project_duration = $r->duration;
        $project->save();

        Session::flash('message', 'Project Updated!');

        return back();
    }


}
