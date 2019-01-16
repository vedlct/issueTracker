<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Project;
use App\Ticket;

class TicketController extends Controller
{
    // view Ticket list
    public function index(){
        return view('Ticket.ticketList');
    }

    // view create ticket
    public function createTicket(){
        $projectlist = Project::all();

        return view('Ticket.createTicket')->with('projectlist', $projectlist);
    }

    // insert ticket
//    public function insertTicket(Request $r){
//        $ticketStatus = Ticket::findOrFail('statusId', '3');
//
//        $ticket = new Ticket();
//        $ticket->ticketTopic = $r->topic;
//        $ticket->ticketStatus = $ticketStatus;
//        $ticket->ticketDetails = $r->details;
//        $ticket->created_at = date('Y-m-d');
//        $ticket->lastUpdated = ;
//        $ticket->ticketPriority = $r->priroty;
//        $ticket->fk_projectId = $r->project;
//        $ticket->fk_ticketOpenerId = Auth::user()->userId;
//        $ticket->save();
//
//        if(Input::hasFile('ticketFile'))
//        {
//            $f = Input::file('file');
//            $att = new Attachment;
//            $att->name = $f->getClientOriginalName();
//            $att->file = base64_encode(file_get_contents($f->getRealPath()));
//            $att->mime = $f->getMimeType();
//            $att->size = $f->getSize();
//            $att->save();
//        }
//
//        ticketFile
//
//        return view('Ticket.createTicket')->with('projectlist', $projectlist);
//    }
}
