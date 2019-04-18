<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use App\Team;
use Session;
use DB;
use App\AssignTeam;
use Yajra\DataTables\DataTables;

class TeamManagementController extends Controller
{
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
        $teamMembers = AssignTeam::Join('user','user.userId','assignteam_new.fk_userId')
                                    ->Join('team','team.teamId','assignteam_new.fkteamId')
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






}
