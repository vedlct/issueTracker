<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use App\Team;
use Session;
use DB;
use App\AssignTeam;

class TeamManagementController extends Controller
{
    public function index(){
        $companylist = Company::all();
        $teamlist = DB::table('team')->select('team.*','company.companyId','company.companyName')
                                ->leftJoin('company','company.companyId','team.fk_companyId')->get();

        return view('Team-management.assignedTeam')->with('companylist', $companylist)
                                                    ->with('teamlist', $teamlist);
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
    public function assignTeam(){
        $teams = Team::all();
        $alreadyBusyEmployee =  AssignTeam::get();
        $array = array();

        foreach ($alreadyBusyEmployee as $emp)
        {
            array_push($array,$emp->fk_userId);
        }

        $freeEmployee = DB::table('user')->leftJoin('assignteam','assignteam.fk_userId','user.userId')
                                         ->where('fk_userTypeId',3)
                                         ->whereNotIn('user.userId', $array)
                                         ->get();

        return view('Team-management.assignNewTeam')->with('teams', $teams)
                                                         ->with('allEmployee',$freeEmployee);
    }


    public function teamAssign(Request $r)
    {
//        return $r;

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




}
