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

class TicketController extends Controller
{
    // view Ticket list
    public function index(){
        return view('Ticket.ticketList');
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
}
