<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Session;
use App\Project;
use App\Ticket;
use App\Status;
use Auth;
use App\User;
use App\TicketReply;
use App\Team;
use Excel;
use App\Exports\TicketExport;
use App\AssignTeam;
use DB;
use App\Employee;
use App\Client;


class TicketController extends Controller
{
    // view Ticket list
    public function index(){

        $teams = Team::all();
        $employee = DB::table('user')->where('fk_userTypeId',3)->get();

        return view('Ticket.ticketList')
            ->with('teams',$teams)
            ->with('employeeList',$employee);



    }

    // view Ticket info
    public function showTicket($id){
        $ticket = Ticket::select('ticket.*','user.fullName','team.teamName')
                        ->Join('user','ticket.fk_ticketOpenerId','user.userId')
                        ->leftJoin('team','team.teamId','ticket.ticketAssignTeamId')
                        ->findOrFail($id);

        $assignedPerson = User::Join('ticket','ticket.ticketAssignPersonUserId','user.userId')->where('ticket.ticketId', $id)->first();

        $teamid = Ticket::findOrFail($id)->first();

        $teamMembers = User::Join('assignteam_new','assignteam_new.fk_userId','user.userId')
                               ->where('assignteam_new.fkteamId', $teamid->ticketAssignTeamId)->get();

        $ticketReplies = TicketReply::select('user.fullName','ticketreply.*')
                                    ->where('fk_ticketId', $id)
                                    ->Join('user','ticketreply.fk_userId','user.userId')->orderBy('created_at')->get();

        $project = Project::where('projectId', $ticket->fk_projectId)->first();
        $user = User::where('userId', $ticket->fk_ticketOpenerId)->first();

        return view('Ticket.ticketDetails')->with('ticket', $ticket)
                                                ->with('ticketReplies', $ticketReplies)
                                                ->with('user', $user)
                                                ->with('teamMembers', $teamMembers)
                                                ->with('assignedPerson', $assignedPerson)
                                                ->with('project', $project);
    }

    // get all Ticket
    public function getAllTicket(Request $r){

        // Get user's company ID
        if(Auth::user()->fk_userTypeId == 2)
        {
            $userCompanyId = Client::where('userId', Auth::user()->userId)->first()->companyId;
        }
        if(Auth::user()->fk_userTypeId == 3)
        {
            $userCompanyId = Employee::where('employeeUserId', Auth::user()->userId)->first()->fk_companyId;
        }
        if(Auth::user()->fk_userTypeId == 4)
        {
            $userCompanyId = Employee::where('employeeUserId', Auth::user()->userId)->first()->fk_companyId;
        }
        if(Auth::user()->fk_userTypeId == 1)
        {
            $userCompanyId = null;
        }

        // get all ticket of user's company
        if($userCompanyId == null)
        {
            $tickets = Ticket::leftJoin('team','team.teamId','ticket.ticketAssignTeamId');
        }
        else
        {
            $tickets = Ticket::leftJoin('team','team.teamId','ticket.ticketAssignTeamId')
                ->where('ticket.ticketOpenerCompanyId', $userCompanyId);

        }


        if($r->startDate){
            $tickets= $tickets->where('created_at', '>=', $r->startDate);
        }
        if($r->endDate){
            $tickets= $tickets->where('created_at', '<=', $r->endDate);
        }
        if($r->ticketStatus){
            $tickets= $tickets->where('ticketStatus', $r->ticketStatus);
        }

        $datatables = Datatables::of($tickets);
        return $datatables->make(true);
    }

    // view create ticket
    public function createTicket(){

        // Get user's company ID
        if(Auth::user()->fk_userTypeId == 2)
        {
            $userCompanyId = Client::where('userId', Auth::user()->userId)->first()->companyId;
        }
        if(Auth::user()->fk_userTypeId == 3)
        {
            $userCompanyId = Employee::where('employeeUserId', Auth::user()->userId)->first()->companyId;
        }
        if(Auth::user()->fk_userTypeId == 4)
        {
            $userCompanyId = Employee::where('employeeUserId', Auth::user()->userId)->first()->fk_companyId;
        }
        if(Auth::user()->fk_userTypeId == 1)
        {
            $userCompanyId = null;
        }

        // get all project of user's company
        if($userCompanyId == null)
        {
            $projectlist = Project::all();
        }
        else
        {
            $projectlist = Project::where('fk_companyId', $userCompanyId)->get();
        }

        return view('Ticket.createTicket')->with('projectlist', $projectlist);
    }

    // insert ticket
    public function insertTicket(Request $r){
        $ticketStatus = Status::where('statusId', '3')->first();

        $date = date('Y-m-d h:i:s');

        $ticket = new Ticket();
        $ticket->ticketTopic = $r->topic;
        $ticket->ticketStatus = $ticketStatus->statusData;
        $ticket->ticketDetails = $r->details;
        $ticket->created_at = $date;
        $ticket->lastUpdated = $date;
        $ticket->ticketPriority = $r->priroty;
        $ticket->fk_projectId = $r->project;
        $ticket->fk_ticketOpenerId = Auth::user()->userId;

        if(Auth::user()->fk_userTypeId == 2)
        {
            $ticketOpenerCompany = Client::where('userId', Auth::user()->userId)->first();
            $companyId = $ticketOpenerCompany->companyId;

            $ticket->ticketOpenerCompanyId = $companyId;
        }
        if(Auth::user()->fk_userTypeId == 3)
        {
            $ticketOpenerCompany = Employee::where('employeeUserId', Auth::user()->userId)->first();
            $companyId = $ticketOpenerCompany->companyId;

            $ticket->ticketOpenerCompanyId = $companyId;
        }
        if(Auth::user()->fk_userTypeId == 1)
        {
            $ticket->ticketOpenerCompanyId = null;
        }


        $ticket->save();

        if ($r->hasFile('file')) {
            $file = $r->file('file');
            $fileName = $ticket->ticketId . "." . $file->getClientOriginalExtension();
            $destinationPath = public_path('files/ticketFile');
            $file->move($destinationPath, $fileName);
            $ticket->ticketFile=$fileName;
            $ticket->save();
        }

        Session::flash('message', 'Ticket Created!');

        return back();
    }

    // return ck editor view
    public function returnCkEditorView(Request $r){
        $ticket = Ticket::findOrFail($r->id);
        return view('Ticket.ckEditorView')->with('ticket', $ticket);
    }

    // update ticket details
    public function updateTicketDetails(Request $r){
        $ticket = Ticket::findOrFail($r->ticket_id);
        $ticket->ticketDetails = $r->details;
        $ticket->save();

        Session::flash('message', 'Ticket Updated!');

        return back();
    }

    // insert ticket reply
    public function insertReply(Request $r){

        $time = date('Y-m-d h:i:s');

        $ticketReply = new TicketReply();
        $ticketReply->replyData = $r->replyData;
        $ticketReply->created_at = $time;
        $ticketReply->ticketReplyType = $r->type;
        $ticketReply->fk_ticketId = $r->ticketId;
        $ticketReply->fk_userId = Auth::user()->userId;
        $ticketReply->save();

        if ($r->hasFile('replyFile')) {
            $file = $r->file('replyFile');
            $fileName = $ticketReply->ticketReplyId . "." . $file->getClientOriginalExtension();
            $destinationPath = public_path('files/ticketReplyFile');
            $file->move($destinationPath, $fileName);
            $ticketReply->ticketReplyFile=$fileName;
            $ticketReply->save();
        }

        Session::flash('message', 'Reply Sent!');

        return back();
    }

    // show ticket edit
    public function ticketEdit($id){
        $teams = Team::all();
        $employee = DB::table('user')->where('fk_userTypeId',3)->get();
        $ticket = Ticket::findOrFail($id);

        return view('Ticket.ticketEdit')->with('ticket', $ticket)
                                             ->with('employeeList', $employee)
                                             ->with('teams', $teams);
    }

    // Update ticket main
    public function updateTicketMain(Request $r){
        $time = date('Y-m-d h:i:s');

        $ticket = Ticket::where('ticketId',$r->ticketId)->first();

        if($r->workedHour == null)
        {
            $ticket->workedHour = null;
        }else{
            $ticket->workedHour = $r->workedHour;
        }

        $ticket->ticketStatus = $r->ticketStatus;
        $ticket->end_at = $time;

        if($r->assignType == 'single')
        {
            $ticket->ticketAssignPersonUserId = $r->assignPersonId;
            $ticket->ticketAssignTeamId = null;
        }
        else
        {
            $ticket->ticketAssignTeamId = $r->teamId;
            $ticket->ticketAssignPersonUserId = null;
        }

        $ticket->save();


        Session::flash('message', 'Ticket Updated!');

        return back();
    }

    public function ticketExport(Request $r){
        Excel::store(new TicketExport($r), 'tickets.xlsx');
        return 'tickets.xlsx';
    }




}
