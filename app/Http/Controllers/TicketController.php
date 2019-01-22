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

class TicketController extends Controller
{
    // view Ticket list
    public function index(){
        return view('Ticket.ticketList');
    }

    // view Ticket info
    public function showTicket($id){
        $ticket = Ticket::findOrFail($id);
        $project = Project::where('projectId', $ticket->fk_projectId)->first();
        $user = User::where('userId', $ticket->fk_ticketOpenerId)->first();

        return view('Ticket.ticketDetails')->with('ticket', $ticket)
                                                ->with('user', $user)
                                                ->with('project', $project);
    }

    // get all Ticket
    public function getAllTicket(Request $r){
        $tickets = Ticket::select('ticket.ticketTopic','ticket.ticketStatus','ticket.created_at','ticket.ticketId');
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
}
