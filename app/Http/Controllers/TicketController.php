<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Project;
use App\Ticket;
use Image;

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
    public function insertTicket(Request $r){
        $ticketStatus = Ticket::findOrFail('statusId', '3');

        $ticket = new Ticket();
        $ticket->ticketTopic = $r->topic;
        $ticket->ticketStatus = $ticketStatus;
        $ticket->ticketDetails = $r->details;
        $ticket->created_at = date('Y-m-d');
        $ticket->lastUpdated = ;
        $ticket->ticketPriority = $r->priroty;
        $ticket->fk_projectId = $r->project;
        $ticket->fk_ticketOpenerId = Auth::user()->userId;
        $ticket->save();

        if($r->hasFile('ticketFile')){
            $img = $r->file('ticketFile');
            $filename= $ticket->ticketId.".".$img->getClientOriginalExtension();
            $pathName='public/ticketFile';
            $location = $pathName.'/'. $filename;
//            Image::make($img)->resize(200, null, function ($constraint) {
//                $constraint->aspectRatio();
//            })->save($location);
            Image::make($img)->save($location);
            $ticket->ticketFile=$filename;
        }

        Session::flash('message', 'Ticket Created!');

        return back();
    }
}
