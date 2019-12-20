<?php

namespace App\Http\Controllers;

use App\BacklogTimeChart;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use App\Team;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;
use App\AssignTeam;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class TeamManagementController extends Controller
{
    public function getCompanyUserId(){
        if(Auth::user()->fk_userTypeId == 2)
        {
            $this->user_company_id = Client::where('userId', Auth::user()->userId)->first()->companyId;
        }
        if(Auth::user()->fk_userTypeId == 3 || Auth::user()->fk_userTypeId == 4 || Auth::user()->fk_userTypeId == 5)
        {
            $this->user_company_id =Auth::user()->fkCompanyId;
        }
        if(Auth::user()->fk_userTypeId == 1)
        {
            $this->user_company_id = null;
        }
        return $this->user_company_id;
    }

    public function index(){
        $companylist = Company::all();
        $teamlist = DB::table('team')->select('team.*','company.companyId','company.companyName')
                                     ->leftJoin('company','company.companyId','team.fk_companyId')->get();

        return view('Team-management.teamList')->with('companylist', $companylist)
                                                    ->with('teamlist', $teamlist);
    }

    // Edit Team
    public function teamEdit($id){
        $companylist = Company::all();
        $team = Team::Join('company','company.companyId','team.fk_companyId')
                        ->where('team.teamId',$id)->first();

        return view('Team-management.editTeam')->with('team', $team)
                                                    ->with('companyList',$companylist);
    }

    // Edit Team
    public function teamUpdate(Request $r){
        $team = Team::findOrFail($r->teamId);
        $team->teamName = $r->teamName;
        $team->fk_companyId = $r->companyId;
        $team->update();

        Session::flash('message', 'Team Updated!');

        return back();
    }

    // insert team
    public function insertTeam(Request $r){
        $date = date('Y-m-d h:i:s');

        $team = new Team();
        $team->created_at = $date;
        $team->fk_companyId = $r->companyId;
        $team->teamName = $r->teamName;
        $team->save();

        Session::flash('message', 'Team Created!');

        return back();
    }

    // Assign team
    public function assignTeamView(){
        $teams = Team::all();
        $alreadyBusyEmployee =  AssignTeam::get();
        $array = array();

        foreach ($alreadyBusyEmployee as $emp)
        {
            array_push($array,$emp->fk_userId);
        }

        $freeEmployee = DB::table('user')->leftJoin('assignteam_new','assignteam_new.fk_userId','user.userId')
                                         ->where('fk_userTypeId',3)
                                         ->whereNotIn('user.userId', $array)
                                         ->get();

        return view('Team-management.assignNewTeam')->with('teams', $teams)
                                                         ->with('allEmployee',$freeEmployee);
    }


    public function teamAssign(Request $r)
    {
        $date = date('Y-m-d h:i:s');

        $teamId = $r->teamId;

        if ($r->ajax()) {
            foreach ($r->userId as $userId) {
                $assignTeam = new AssignTeam();
                $assignTeam->created_at = $date;
                $assignTeam->fk_userId = $userId;
                $assignTeam->fkteamId = $teamId;
                $assignTeam->save();
            }
            return Response('true');
        }
    }

    // team members
    public function teamMembers(){
        return view('Team-management.assignedTeamMembers');
    }

    // get all team member
    public function getAllTeamMembers(){
        $teamMembers = AssignTeam::leftJoin('user','user.userId','assignteam_new.fk_userId')
                                    ->leftJoin('team','team.teamId','assignteam_new.fkteamId')
                                    ->get();

        $datatables = Datatables::of($teamMembers);
        return $datatables->make(true);
    }

    // remove employee
    public function removeEmployee(Request $r){
        $teamEmployee = AssignTeam::findOrFail($r->id);
        $teamEmployee->delete();
        return back();
    }

    public function teamWork(){
        return view('Team-management.teamWork');
    }

    public function teamWorkData(Request $data){
        $userCompanyId = $this->getCompanyUserId();

        if($userCompanyId != null){
            $employeelist = BacklogTimeChart::select('user.*','backlog.*','project.*','backlog_time_chart.*')
                ->leftJoin('user','user.userId','backlog_time_chart.user_id')
                ->leftJoin('backlog','backlog.backlog_id','backlog_time_chart.backlog_id')
                ->leftJoin('project','project.projectId','backlog.fk_project_id')
                ->whereIn('user.fk_userTypeId',[5,3])
                ->whereBetween('backlog_time_chart.date', [$data->start_date, $data->end_date])
                ->where('project.fk_company_id', $userCompanyId)
                ->get();
            $datatables = Datatables::of($employeelist);
            return $datatables->make(true);
        }
    }


}
