<?php

namespace App\Http\Controllers;

use App\Backlog;
use App\ClientContactPersonUserRelation;
use App\ClientProjectRelation;
use App\ProjectPartner;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Company;
use Auth;
use Illuminate\Support\Facades\Mail;
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
        if(Auth::user()->fk_userTypeId == 3 || Auth::user()->fk_userTypeId == 4)
        {
            $this->user_company_id = Auth::user()->fkCompanyId;
        }
//        if(Auth::user()->fk_userTypeId == 4)
//        {
//            $this->user_company_id = Employee::where('employeeUserId', Auth::user()->userId)->first()->fk_companyId;
//        }
        if(Auth::user()->fk_userTypeId == 1)
        {
            $this->user_company_id = null;
        }

        return $this->user_company_id;
    }

    // view Project list
    public function index(){

         $userCompany = $this->getCompanyUserId();

        $projects = Project::select('project.project_name','status.statusData','user.fullName','company.companyName','project.projectId', 'project.project_type', 'client.clientName')
            ->leftjoin('company','project.fk_company_id','company.companyId')
            ->leftjoin('user','project.project_created_by','user.userId')
            ->leftjoin('status','project.project_status','status.statusId')
            ->leftjoin('client', 'project.fk_client_id', 'client.clientId')
            ->where('project.project_status', '!=' ,6)
            ->orderBy('project.projectId','desc')
            ->where('project.project_deleted_at', null);

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
                ->leftjoin('company','project.fk_company_id','company.companyId')
                ->leftjoin('user','project.project_created_by','user.userId')
                ->leftjoin('status','project.project_status','status.statusId')
                ->leftjoin('client', 'project.fk_client_id', 'client.clientId')
                ->where('project.project_status', '!=' ,6)
                ->orderBy('project.projectId','desc')
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
                                    ->orderBy('project.projectId','desc')
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
                    ->orderBy('project.projectId','desc')
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
                ->leftjoin('company','project.fk_company_id','company.companyId')
                ->leftjoin('user','project.project_created_by','user.userId')
                ->leftjoin('status','project.project_status','status.statusId')
                ->leftjoin('client', 'project.fk_client_id', 'client.clientId')
                ->where('project.project_status', 6)
                ->orderBy('project.projectId','desc')
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
                    ->orderBy('project.projectId','desc')
                    ->where('fk_company_id',$userCompanyId);
            }
            else
            {
                $projects = Project::select('project.project_name','status.statusData','user.fullName','company.companyName','project.projectId', 'project.project_type', 'client.clientName')
                    ->leftJoin('company','project.fk_company_id','company.companyId')
                    ->leftJoin('user','project.project_created_by','user.userId')
                    ->leftjoin('client', 'project.fk_client_id', 'client.clientId')
                    ->leftJoin('status','project.project_status','status.statusId')
                    ->orderBy('project.projectId','desc')
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

//            $partnerCompany=User::select('company.companyName','user.userId')
//                ->where('user.fk_userTypeId',4)
//                ->leftJoin('companyemployee','companyemployee.employeeUserId','user.userId')
//                ->leftJoin('company','companyemployee.fk_companyId','company.companyId')
//                ->get();
            $partnerCompany=$companylist;
        }
        else
        {
            $companylist = Company::where('companyId', $userCompanyId)->get();

//            $partnerCompany=User::select('company.companyName','user.userId')
//                ->where('user.fk_userTypeId',4)
//                ->where('company.companyId','!=', $userCompanyId)
//                ->leftJoin('companyemployee','companyemployee.employeeUserId','user.userId')
//                ->leftJoin('company','companyemployee.fk_companyId','company.companyId')
//                ->get();
            $partnerCompany=Company::where('companyId', '!=',$userCompanyId)->get();

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


        return view('Project.projectCreate', ['companylist' => $companylist, 'statusAll' => $status,
            'clients'=>$clients,'partnerCompany'=>$partnerCompany]);
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


            $project->fk_company_id = $this->getCompanyUserId();

            if ($r->client==OTHERS){

                $client=new Client();
                $client->clientName=$r->clientName;
                $client->clientCompanyId=$this->getCompanyUserId();
                $client->created_at=date("Y-m-d H:i:s");
                $client->save();

                $project->fk_client_id = $client->clientId;

            }else{

                $project->fk_client_id = $r->client;
            }
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

        if (!empty($r->fkPartnerCompanyId)&& array_filter($r->fkPartnerCompanyId)){

            for ($i=0;$i<count($r->fkPartnerCompanyId);$i++){

                $projectPartner=new ProjectPartner();
                $projectPartner->fkProjectId=$project->projectId;
                $projectPartner->fkPartnerCompanyId=$r->fkPartnerCompanyId[$i];
                $projectPartner->save();

            }



        }



        Session::flash('message', 'Project Created!');

        return back();
    }

    // view edit company form
    public function edit_project($id){

         $allStatus = Status::where('statusType', 'project_status')->get();

        $project = Project::findOrFail($id);

         $projectPartnerList=ProjectPartner::select('project_partner.projectPartnerId','company.companyId','company.companyName')
            ->leftJoin('company','company.companyId','project_partner.fkPartnerCompanyId')
            ->where('fkProjectId',$id)
            ->get();

         $thisProjectPartnerList=ProjectPartner::select('company.companyId')
             ->leftJoin('company','company.companyId','project_partner.fkPartnerCompanyId')
             ->where('fkProjectId',$id)
             ->get();


        $userCompanyId = $this->getCompanyUserId();

        if($userCompanyId == null)
        {
            $partnerCompany=Company::whereNotIn('company.companyId',$thisProjectPartnerList)->get();
        }
        else
        {
            $partnerCompany=Company::where('companyId', '!=',$userCompanyId)
                ->whereNotIn('company.companyId',$thisProjectPartnerList)
                ->get();
        }

        $clients = Client::where('clientCompanyId',$this->getCompanyUserId())->get();

       // return $partnerCompany;

        return view('Project.projectEdit')->with('project', $project)
//                                               ->with('companylist', $companylist)
                                               ->with('clients', $clients)
                                               ->with('partnerCompany', $partnerCompany)
                                               ->with('projectPartnerList', $projectPartnerList)
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
//            $project->fk_client_id = $r->client;
//            $project->fk_company_id = $this->getCompanyUserId();

            $project->fk_company_id = $this->getCompanyUserId();

            if ($r->client==OTHERS){

                $client=new Client();

                $client->clientName=$r->clientName;
                $client->clientCompanyId=$this->getCompanyUserId();
                $client->created_at=date("Y-m-d H:i:s");
                $client->save();

                $project->fk_client_id = $client->clientId;

            }else{

                $project->fk_client_id = $r->client;
            }

        }
        $project->project_type = $r->projectType;
        $project->project_status = $r->status;
        $project->project_start_date = Carbon::parse($r->projectStartDate)->format('Y-m-d');
        $project->project_summary = $r->summary;
        $project->project_duration = $r->duration;
        $project->save();

        if (!empty($r->fkPartnerCompanyId)&& array_filter($r->fkPartnerCompanyId)){

            for ($i=0;$i<count($r->fkPartnerCompanyId);$i++){

                $projectPartner=new ProjectPartner();
                $projectPartner->fkProjectId=$project->projectId;
                $projectPartner->fkPartnerCompanyId=$r->fkPartnerCompanyId[$i];
                $projectPartner->save();

            }



        }

        Session::flash('message', 'Project Updated!');

        return back();
    }

    public function projectPartnerDelete($id){

        $projectPartner=ProjectPartner::findOrFail($id);
        $projectPartner->delete();

        Session::flash('message', 'Project Partner Deleted!');

        return back();

    }
    public function projectPartnerProjectList(){

        $userCompany = $this->getCompanyUserId();

        // Calculate project percentage
        if($userCompany == null)
        {
            $projects = ProjectPartner::all();
        }
        else
        {

            $projects = ProjectPartner::where('fkPartnerCompanyId', $userCompany)->get();

        }

        $percentage_all = array();

        foreach ($projects as $project)
        {
            $completedBacklog = Backlog::where('fk_project_id', $project->fkProjectId)
                ->where('backlog_state', 'complete')
                ->count();

            $totalBacklog = Backlog::where('fk_project_id', $project->fkProjectId)->count();
            if($totalBacklog == 0)
            {
                $percentage = 0;
            }
            else
            {
                $percentage = ($completedBacklog*100)/$totalBacklog;
            }
            $percentage_all[$project->fkProjectId] = round($percentage);
        }

        // return $percentage_all;
        return view('Project.partnerProjectList')->with('project_percentage', $percentage_all);

    }

    public function getAllprojectPartnerProjectList(Request $r)
    {
        $userCompanyId = $this->getCompanyUserId();

        $projects = Project::select('project.project_name','status.statusData','user.fullName','company.companyName','project.projectId', 'project.project_type', 'client.clientName')
            ->leftJoin('company','project.fk_company_id','company.companyId')
            ->leftJoin('user','project.project_created_by','user.userId')
            ->leftJoin('status','project.project_status','status.statusId')
            ->leftjoin('client', 'project.fk_client_id', 'client.clientId')
            ->leftjoin('project_partner', 'project_partner.fkProjectId', 'project.projectId')
            ->where('project.project_status', '!=' ,6)
            ->orderBy('project.projectId','desc')
            ->where('project_partner.fkPartnerCompanyId',$userCompanyId);


            $datatables = Datatables::of($projects);
            return $datatables->make(true);

    }

    public function projectProposal(){
        return view('Project.Proposal.create');
    }

    public function projectProposalSubmit(Request $data){
        $project = new Project();
        $project->project_name = $data->projectname;
        if (!empty($data->clientname)){
            $client=new Client();
            $client->clientName=$data->clientname;
            $client->clientCompanyId=$this->getCompanyUserId();
            $client->created_at=date("Y-m-d H:i:s");
            $client->save();
            $project->fk_client_id = $client->clientId;
        }
        $project->project_status = '7';
        $project->project_duration = $data->duration;
        $project->project_created_by = Auth::user()->userId;
        $project->project_created_at = date("Y-m-d H:i:s");
        $project->save();

        if (count($data->feature)>0){
            foreach ($data->feature as $feature){
                if (!empty($feature)){
                    $backlog = new Backlog();
                    $backlog->backlog_title = $feature;
                    $backlog->fk_project_id = $project->projectId;
                    $backlog->backlog_state = 'Proposed';
                    $backlog->backlog_created_at = date("Y-m-d H:i:s");
                    $backlog->save();
                }
            }
        }
        $froMail = User::select('email','fk_userTypeId')->where('fkCompanyId',Auth::user()->fkCompanyId)->whereIn('fk_userTypeId',[5,4])->get();
        if (count($froMail)>0){
            $address = $froMail->where('fk_userTypeId',4)->first()->email;
            $mailAddresses = [];
            foreach ($froMail as $mailAddress) {
                if ($mailAddress->email != $address){
                    $mailAddresses[] = $mailAddress->email;
                }
            }

            Mail::send('mail.acknowledgement', ['info' => $data], function($message)use($mailAddresses,$address)
            {
                $message->to($address, 'Admin')
                    ->cc($mailAddresses)
                    ->subject('New Proposal Created');
            });
        }
        return redirect('/');
    }

    public function proposedProject(Request $data){

        $projects = Project::select('project.project_created_at','project.project_duration','project.project_name','status.statusData','user.fullName','company.companyName','project.projectId', 'project.project_type', 'client.clientName')
            ->leftJoin('company','project.fk_company_id','company.companyId')
            ->leftJoin('user','project.project_created_by','user.userId')
            ->leftJoin('status','project.project_status','status.statusId')
            ->leftjoin('client', 'project.fk_client_id', 'client.clientId')
            ->leftjoin('project_partner', 'project_partner.fkProjectId', 'project.projectId')
            ->where('project.project_status', '=' ,7)
            ->orderBy('project.projectId','desc');

        return Datatables::of($projects)->make(true);
    }

    public function proposedfeature(Request $data){
        return Backlog::select('backlog_title')->where('fk_project_id', $data->projectId)->get();
    }


}
