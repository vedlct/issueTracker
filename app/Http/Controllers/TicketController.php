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


class TicketController extends Controller
{
    // view Ticket list
    public function index(){
        $teams = Team::all();
        $tickets = Ticket::leftJoin('team','team.teamId','ticket.ticketAssignTeamId')->get();
        return view('Ticket.ticketList')->with('teams',$teams)
                                             ->with('tickets', $tickets);
    }

    // view Ticket info
    public function showTicket($id){
        $ticket = Ticket::select('ticket.*','user.fullName','team.teamName')
                        ->Join('user','ticket.fk_ticketOpenerId','user.userId')
                        ->leftJoin('team','team.teamId','ticket.ticketAssignTeamId')
                        ->findOrFail($id);

        $teamid = Ticket::findOrFail($id)->first();

//        dd($teamid->ticketAssignTeamId);

        $teamMembers = User::Join('assignteam_new','assignteam_new.fk_userId','user.userId')
                               ->where('assignteam_new.fkteamId', $teamid->ticketAssignTeamId)->get();
//        dd($teamMembers);

        $ticketReplies = TicketReply::select('user.fullName','ticketreply.*')
                                    ->where('fk_ticketId', $id)
                                    ->Join('user','ticketreply.fk_userId','user.userId')->orderBy('created_at')->get();

        $project = Project::where('projectId', $ticket->fk_projectId)->first();
        $user = User::where('userId', $ticket->fk_ticketOpenerId)->first();

        return view('Ticket.ticketDetails')->with('ticket', $ticket)
                                                ->with('ticketReplies', $ticketReplies)
                                                ->with('user', $user)
                                                ->with('teamMembers', $teamMembers)
                                                ->with('project', $project);
    }

    // get all Ticket
    public function getAllTicket(Request $r){
        $tickets = Ticket::leftJoin('assignteam_new','assignteam_new.fkteamId','ticket.ticketAssignTeamId')
            ->leftJoin('team','team.teamId','assignteam_new.fkteamId')
            ->select('*');
//        dd($tickets);
        $datatables = Datatables::of($tickets);
        return $datatables->make(true);
    }

    // view create ticket
    public function createTicket(){
        $projectlist = Project::all();
        return view('Ticket.createTicket')->with('projectlist', $projectlist);
    }

    // insert ticket
    public function insertTicket(Request $r){
        $ticketStatus = Status::where('statusId', '3')->first();

        date_default_timezone_set('Asia/Dhaka');
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

        date_default_timezone_set('Asia/Dhaka');
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

    public function ticketEdit(){
        return view('Ticket.ticketEdit');
    }

    public function updateTicketMain(Request $r){
        $ticket = Ticket::where('ticketId',$r->ticketId)->first();
        $ticket->workedHour = $r->workedHour;
        $ticket->ticketStatus = $r->ticketStatus;
        $ticket->ticketAssignTeamId = $r->teamId;
        $ticket->save();

        Session::flash('message', 'Ticket Updated!');

        return back();
    }

    public function ticketExport(){
        return Excel::download(new TicketExport, 'tickets.xlsx');
    }




}
