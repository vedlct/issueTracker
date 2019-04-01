<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Backlog;

class ProjectBacklogManagementController extends Controller
{
    // Backlog Dashboard
    public function dashboard($id){
        return view('Project.BacklogManagement.mybackloglist')->with('project_id', $id);
    }

    // get all Backlog
    public function getAllBackground(Request $r){

        $project_all_backlogs = Backlog::where('fk_project_id', $r->project_id)
                                        ->orderBy('backlog.backlog_id','desc' )
                                        ->get();

        return view('Project.BacklogManagement.getAllBacklog')->with('backlogs', $project_all_backlogs);
    }

    // Backlog Details
    public function backlogDetails(Request $r){

        $backlog = Backlog::findOrFail($r->backlog_id);

        return view('Project.BacklogManagement.backlog_single')->with('backlog', $backlog);
    }
}
