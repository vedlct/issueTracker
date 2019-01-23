<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use App\Team;
use Session;

class AssignteamController extends Controller
{
    public function index(){
        $companylist = Company::all();
        $users = Company::all();
        return view('Assignteam.assignedTeam')->with('companylist', $companylist);
    }

    // insert team
    public function insertTeam(Request $r){
//        date_default_timezone_set('Asia/Dhaka');
        $date = date('Y-m-d h:i:s');

        $team = new Team();
        $team->created_at = $date;
        $team->fk_companyId = $r->companyId;
        $team->teamName = $r->teamName;
        $team->save();

        Session::flash('message', 'Team Created!');

        return back();
    }
}
