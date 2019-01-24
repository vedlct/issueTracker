<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use App\Team;
use Session;
use DB;

class AssignteamController extends Controller
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
        $freeEmployee = DB::table('user')->leftJoin('assignteam','assignteam.fk_userId','user.userId')
                                        ->where('fk_userTypeId',3)
                                        ->get();
        return view('Team-management.assignNewTeam')->with('teams', $teams)
                                                         ->with('allEmployee',$freeEmployee);
    }
}
