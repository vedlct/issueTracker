<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
use Illuminate\Support\Facades\Mail;


class TicketController extends Controller
{
    public $user_company_id;

    // Get user's company user id
    public function getCompanyUserId(){

        if(Auth::user()->fk_userTypeId == 2)
        {
            $this->user_company_id = Client::where('userId', Auth::user()->userId)->first()->companyId;
        }
        if(Auth::user()->fk_userTypeId == 3)
        {
            $this->user_company_id = Auth::user()->fkCompanyId;
        }
        if(Auth::user()->fk_userTypeId == 4)
        {
//            $this->user_company_id = Auth::user()->fkCompanyId;
            $this->user_company_id = Employee::where('employeeUserId', Auth::user()->userId)->first()->fk_companyId;
        }
        if(Auth::user()->fk_userTypeId == 1)
        {
            $this->user_company_id = null;
        }

        return $this->user_company_id;
    }


    // view Ticket list
    public function index(){

        $userCompanyId = $this->getCompanyUserId();

        if($userCompanyId == null)
        {
            $date = date('Y-m-d h:i:s');

            $allTicket= Ticket::all()->count();
            $openCount = Ticket::where('ticketStatus', 'Open')->count();
            $overDueCount = Ticket::whereDate('ticket.exp_end_date', '<=', $date)->where('ticketStatus', '!=', 'Close')->count();
            $pendingCount = Ticket::where('ticketStatus', 'Pending')->count();
            $closeCount = Ticket::where('ticketStatus', 'Close')->count();;
        }
        else
        {
            $date = date('Y-m-d h:i:s');

            $allTicket= Ticket::where('ticketOpenerCompanyId', $userCompanyId)->count();

            $openCount = Ticket::where('ticketOpenerCompanyId', $userCompanyId)
                ->where('ticketStatus', 'Open')
                ->count();
            $overDueCount = Ticket::where('ticketOpenerCompanyId', $userCompanyId)
                ->whereDate('ticket.exp_end_date', '<=', $date)
                ->where('ticket.ticketStatus', '!=', 'Close')
                ->count();
            $pendingCount = Ticket::where('ticketOpenerCompanyId', $userCompanyId)
                ->where('ticketStatus', 'Pending')
                ->count();
            $closeCount = Ticket::where('ticketOpenerCompanyId', $userCompanyId)
                ->where('ticketStatus', 'Close')
                ->count();;
        }



        if($userCompanyId == null)
        {
            $teams = Team::all();
            $allEmp = User::where('fk_userTypeId', 3)->get();
        }
        else
        {
            $teams = Team::where('fk_companyId', $userCompanyId)->get();
            $allEmp = User::leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')->where('companyemployee.fk_companyId', $userCompanyId)->where('user.fk_userTypeId', 3)->get();
        }


        return view('Ticket.ticketList')->with('openticket', $openCount)
                                             ->with('overdue', $overDueCount)
                                             ->with('pending', $pendingCount)
                                             ->with('allticket', $allTicket)
                                             ->with('teams', $teams)
                                             ->with('allEmp', $allEmp)
                                             ->with('close', $closeCount);
    }

    // view Ticket info
    public function showTicket($id){

        if(!Auth::check()) {

            return redirect()->route('login')->with('ticket_id');

        }
        else
        {
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
    }

    // get all Ticket
    public function getAllTicket(Request $r){

        // Get user's company ID
        $userCompanyId = $this->getCompanyUserId();


        // get all ticket of user's company if ticketTye is not null
        if($r->ticketType != null)
        {
            // only for super admin
            if($userCompanyId == null)
            {
                if($r->overDue == "overdue")
                {
                    $date = date('Y-m-d h:i:s');
                    $tickets = Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"),'ticket.*','createdUser.fullName as createdFullName','assignUser.fullName as assignFullName')
                        ->leftJoin('project','project.projectId','ticket.fk_projectId')
                        ->leftJoin('user as createdUser','createdUser.userId','ticket.fk_ticketOpenerId')
                        ->leftJoin('user as assignUser','assignUser.userId','ticket.ticketAssignPersonUserId')
                        ->leftJoin('assignteam_new','assignteam_new.fkteamId','ticket.ticketAssignTeamId')
                        ->leftJoin('user','user.userId','assignteam_new.fk_userId')
                        ->whereDate('ticket.exp_end_date', '<=', $date)
                        ->where('ticket.ticketStatus', '!=', 'Close')
                        ->groupBy('ticket.ticketId');
                }
                elseif ($r->allTicket == "all")
                {
                    $tickets = Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"),'ticket.*','createdUser.fullName as createdFullName','assignUser.fullName as assignFullName')
                        ->leftJoin('project','project.projectId','ticket.fk_projectId')
                        ->leftJoin('user as createdUser','createdUser.userId','ticket.fk_ticketOpenerId')
                        ->leftJoin('user as assignUser','assignUser.userId','ticket.ticketAssignPersonUserId')
                        ->leftJoin('assignteam_new','assignteam_new.fkteamId','ticket.ticketAssignTeamId')
                        ->leftJoin('user','user.userId','assignteam_new.fk_userId')
                        ->groupBy('ticket.ticketId');
                }
                else
                {
                    $tickets = Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"),'ticket.*','createdUser.fullName as createdFullName','assignUser.fullName as assignFullName')
                        ->leftJoin('project','project.projectId','ticket.fk_projectId')
                        ->leftJoin('user as createdUser','createdUser.userId','ticket.fk_ticketOpenerId')
                        ->leftJoin('user as assignUser','assignUser.userId','ticket.ticketAssignPersonUserId')
                        ->leftJoin('assignteam_new','assignteam_new.fkteamId','ticket.ticketAssignTeamId')
                        ->leftJoin('user','user.userId','assignteam_new.fk_userId')
                        ->where('ticket.ticketStatus', $r->ticketType)
                        ->groupBy('ticket.ticketId');
                }
            }
            // other user
            else
            {
                if($r->overDue == "overdue")
                {
                    $date = date('Y-m-d h:i:s');
                    $tickets = Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"),'ticket.*','createdUser.fullName as createdFullName','assignUser.fullName as assignFullName')
                        ->leftJoin('project','project.projectId','ticket.fk_projectId')
                        ->leftJoin('user as createdUser','createdUser.userId','ticket.fk_ticketOpenerId')
                        ->leftJoin('user as assignUser','assignUser.userId','ticket.ticketAssignPersonUserId')
                        ->leftJoin('assignteam_new','assignteam_new.fkteamId','ticket.ticketAssignTeamId')
                        ->leftJoin('user','user.userId','assignteam_new.fk_userId')
                        ->where('ticket.ticketOpenerCompanyId', $userCompanyId)
                        ->whereDate('ticket.exp_end_date', '<=', $date)
                        ->where('ticket.ticketStatus', '!=', 'Close')
                        ->groupBy('ticket.ticketId');
                }
                elseif ($r->allTicket == "all")
                {
                    $tickets = Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"),'ticket.*','createdUser.fullName as createdFullName','assignUser.fullName as assignFullName')
                        ->leftJoin('project','project.projectId','ticket.fk_projectId')
                        ->leftJoin('user as createdUser','createdUser.userId','ticket.fk_ticketOpenerId')
                        ->leftJoin('user as assignUser','assignUser.userId','ticket.ticketAssignPersonUserId')
                        ->leftJoin('assignteam_new','assignteam_new.fkteamId','ticket.ticketAssignTeamId')
                        ->leftJoin('user','user.userId','assignteam_new.fk_userId')
                        ->where('ticket.ticketOpenerCompanyId', $userCompanyId)
                        ->groupBy('ticket.ticketId');
                }
                else
                {
                    $tickets = Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"),'ticket.*','createdUser.fullName as createdFullName','assignUser.fullName as assignFullName')
                        ->leftJoin('project','project.projectId','ticket.fk_projectId')
                        ->leftJoin('user as createdUser','createdUser.userId','ticket.fk_ticketOpenerId')
                        ->leftJoin('user as assignUser','assignUser.userId','ticket.ticketAssignPersonUserId')
                        ->leftJoin('assignteam_new','assignteam_new.fkteamId','ticket.ticketAssignTeamId')
                        ->leftJoin('user','user.userId','assignteam_new.fk_userId')
                        ->where('ticket.ticketOpenerCompanyId', $userCompanyId)
                        ->where('ticket.ticketStatus', $r->ticketType)
                        ->groupBy('ticket.ticketId');
                }
            }
        }
        // get all ticket of user's company if ticket type is null
        else
        {
            if($userCompanyId == null)
            {
                $tickets = Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"),'ticket.*','createdUser.fullName as createdFullName','assignUser.fullName as assignFullName')
                    ->leftJoin('project','project.projectId','ticket.fk_projectId')
                    ->leftJoin('user as createdUser','createdUser.userId','ticket.fk_ticketOpenerId')
                    ->leftJoin('user as assignUser','assignUser.userId','ticket.ticketAssignPersonUserId')
                    ->leftJoin('assignteam_new','assignteam_new.fkteamId','ticket.ticketAssignTeamId')
                    ->leftJoin('user','user.userId','assignteam_new.fk_userId')
                    ->groupBy('ticket.ticketId');
            }
            else
            {
                $tickets = Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"),'ticket.*','createdUser.fullName as createdFullName','assignUser.fullName as assignFullName')
                    ->leftJoin('project','project.projectId','ticket.fk_projectId')
                    ->leftJoin('user as createdUser','createdUser.userId','ticket.fk_ticketOpenerId')
                    ->leftJoin('user as assignUser','assignUser.userId','ticket.ticketAssignPersonUserId')
                    ->leftJoin('assignteam_new','assignteam_new.fkteamId','ticket.ticketAssignTeamId')
                    ->leftJoin('user','user.userId','assignteam_new.fk_userId')
                    ->where('ticket.ticketOpenerCompanyId', $userCompanyId)
                    ->groupBy('ticket.ticketId');
            }
        }



        // filter
        if($r->startDate){
            $tickets= $tickets->whereDate('ticket.created_at', '>=', $r->startDate);
        }
        if($r->endDate){
            $tickets= $tickets->whereDate('ticket.created_at', '<=', $r->endDate);
        }
        if($r->ticketStatus){
            $tickets= $tickets->where('ticket.ticketStatus', $r->ticketStatus);
        }

        $tickets= $tickets->orderBy('ticket.ticketId', 'desc');


        $datatables = Datatables::of($tickets->get());
        return $datatables->make(true);
    }

    // view create ticket
    public function createTicket(){

        // Get user's company ID
        $userCompanyId = $this->getCompanyUserId();

        // get all project of user's company
        if($userCompanyId == null)
        {
            $projectlist = Project::all();
        }
        else
        {
            $projectlist = Project::where('fk_company_id', $userCompanyId)->get();
        }

        return view('Ticket.createTicket')->with('projectlist', $projectlist);
    }

    // insert ticket
    public function insertTicket(Request $r){

        // Get user's company ID
        $userCompanyId = $this->getCompanyUserId();

        //
        if($userCompanyId != null)
        {
            // get all client's company's all employee user_id
            $allEmp = Employee::where('fk_companyId', $userCompanyId)->get();

            $array = array();

            foreach ($allEmp as $emp)
            {
                array_push($array, $emp->employeeUserId);
            }

            $allEmployeeEmails = User::whereIn('userId', $array)->select('email')->get();

            $array1 = array();
            foreach ($allEmployeeEmails as $emp)
            {
                array_push($array1, $emp->email);
            }


            // get all client's company's all client user_id
            $allclient = Client::where('companyId', $userCompanyId)->get();
            $array = array();

            foreach ($allclient as $client)
            {
                array_push($array, $client->userId);
            }

            $allClientEmails = User::whereIn('userId', $array)->select('email')->get();

            foreach ($allClientEmails as $client)
            {
                array_push($array1, $client->email);
            }
        }
        else
        {
            Session::flash('error_msg', 'Super admin cant create ticket!');

            return back();
        }


        $ticketStatus = Status::where('statusId', '3')->first();

        $date = date('Y-m-d h:i:s');

        $ticket = new Ticket();
        $ticket->ticketTopic = $r->topic;
        $ticket->ticketStatus = $ticketStatus->statusData;
        $ticket->ticketDetails = $r->details;
        $ticket->created_at = $r->create_date;
        $ticket->lastUpdated = $date;
        $ticket->ticketPriority = $r->priroty;
        $ticket->exp_end_date = $r->exp_end_date;
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
            $companyId = $ticketOpenerCompany->fk_companyId;

            $ticket->ticketOpenerCompanyId = $companyId;
        }
        if(Auth::user()->fk_userTypeId == 4)
        {
            $ticketOpenerCompany = Employee::where('employeeUserId', Auth::user()->userId)->first();
            $companyId = $ticketOpenerCompany->fk_companyId;

            $ticket->ticketOpenerCompanyId = $companyId;
        }
        if(Auth::user()->fk_userTypeId == 1)
        {
            $ticket->ticketOpenerCompanyId = null;
        }


        $ticket->save();

        // set ticket number
        $ticket_no = mt_rand(100000, 999999);
        $ticket_no_i = Ticket::where('ticket_number', $ticket_no)->get();

        while(count($ticket_no_i) > 0)
        {
            $ticket_no = mt_rand(100000, 999999);
            $ticket_no_i = Ticket::where('ticket_number', $ticket_no)->get();
        }

        $ticket = Ticket::findOrFail($ticket->ticketId);
        $ticket->ticket_number = $ticket_no;
        $ticket->save();


        if ($r->hasFile('file')) {
            $file = $r->file('file');
            $fileName = $ticket->ticketId . "." . $file->getClientOriginalExtension();
            $destinationPath = public_path('files/ticketFile');
            $file->move($destinationPath, $fileName);
            $ticket->ticketFile=$fileName;
            $ticket->save();
        }
        // set ticket number end

        // set mailing information
        $ticketOpenerName = Auth::user()->fullName;
        $priority = $r->priroty;
        $details = $r->details;
        $projectName = Project::where('projectId', $r->project)->first()->project_name;
        $company_admin_mail = User::leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')
                                  ->where('user.fk_userTypeId', 4)
                                  ->where('companyemployee.fk_companyId', $userCompanyId)
                                  ->first()->email;

        $data=array(
            'name'=> 'Arabi Kabir',
            'email'=> $company_admin_mail,
            'message'=> 'New Ticket is created',
            'ticketOpenerName'=> $ticketOpenerName,
            'priority'=> $priority,
            'details'=> $details,
            'projectName'=> $projectName,
            'ticketNo'=> $ticket_no,
            'ticketId'=> $ticket->ticketId,
        );

        Mail::send('Ticket.mailView', $data, function($message) use ($data, $array1)
        {
            $message->to($data['email'], 'Company Admin')
                    ->cc($array1)
                    ->subject('New Ticket Created');
        });
        // End Send Mail


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

        $userCompanyId = $this->getCompanyUserId();

        // get all email of user's company
        if($userCompanyId != null)
        {
            // get ticket opener email
            $array1 = array();
            $ticketopenerId = Ticket::where('ticketId', $r->ticketId)->first()->fk_ticketOpenerId;
            $ticketTopic = Ticket::where('ticketId', $r->ticketId)->first()->ticketTopic;
            $ticketId = Ticket::where('ticketId', $r->ticketId)->first()->ticket_number;
            $ticketOpener = User::where('userId', $ticketopenerId)->first()->fullName;
            $userId = User::where('userId', $ticketopenerId)->first()->email;
            array_push($array1, $userId);

            // get company admin email

            // get all client's company's all employee user_id
            $allEmp = Employee::where('fk_companyId', $userCompanyId)->get();

            $array = array();

            foreach ($allEmp as $emp)
            {
                array_push($array, $emp->employeeUserId);
            }

            $allEmployeeEmails = User::whereIn('userId', $array)->where('fk_userTypeId', 4)->select('email')->get();

            foreach ($allEmployeeEmails as $emp)
            {
                array_push($array1, $emp->email);
            }
        }
        else
        {
            Session::flash('error_msg', 'Super admin cant reply on ticket!');

            return back();
        }

        $company_admin_mail = User::leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')
            ->where('user.fk_userTypeId', 4)
            ->where('companyemployee.fk_companyId', $userCompanyId)
            ->first()->email;

        $data=array(
            'name'=> 'Issuetracker',
            'email'=> $company_admin_mail,
            'message'=> $r->replyData,
            'reply_user'=> Auth::user()->fullName,
            'reply'=> $r->replyData,
            'ticketOpner' => $ticketOpener,
            'ticketTopic' => $ticketTopic,
            'ticketNo' => $ticketId,
            'ticketId' => $r->ticketId,
        );


        Mail::send('Ticket.replyMailView', $data, function($message) use ($data,$array1)
        {
            $message->to($data['email'], 'Ticket Reply Mail')
                    ->cc($array1)
                    ->subject('New Ticket Reply');
        });


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
    public function ticketEdit(Request $r){

        // Get user's company ID
        $userCompanyId = $this->getCompanyUserId();


        if($userCompanyId == null)
        {
            $teams = Team::all();
            $employee = DB::table('user')->where('fk_userTypeId',3)->get();
        }
        else
        {
            $teams = Team::where('fk_companyId', $userCompanyId)->get();

            $employee = DB::table('user')->leftJoin('companyemployee', 'user.userId', 'companyemployee.employeeUserId')
                                         ->where('user.fk_userTypeId',3)
                                         ->where('companyemployee.fk_companyId', $userCompanyId)
                                         ->get();
        }



        $ticket = Ticket::findOrFail($r->id);

        return view('Ticket.ticketEdit')->with('ticket', $ticket)
                                             ->with('employeeList', $employee)
                                             ->with('teams', $teams);
    }

    // show generate excel page
    public function showGenerateExcel(){

        // Get user's company ID
        $userCompanyId = $this->getCompanyUserId();


        if($userCompanyId == null)
        {
            $date = date('Y-m-d h:i:s');


            $allTicket= Ticket::all()->count();
            $openCount = Ticket::where('ticketStatus', 'Open')
                ->count();
            $overDueCount = Ticket::whereDate('ticket.exp_end_date', '<=', $date)
                ->where('ticketStatus', '!=', 'Close')
                ->count();
            $pendingCount = Ticket::where('ticketStatus', 'Pending')
                ->count();
            $closeCount = Ticket::where('ticketStatus', 'Close')
                ->count();;
        }
        else
        {
            $date = date('Y-m-d h:i:s');

            $allTicket= Ticket::where('ticketOpenerCompanyId', $userCompanyId)->count();

            $openCount = Ticket::where('ticketOpenerCompanyId', $userCompanyId)
                ->where('ticketStatus', 'Open')
                ->count();
            $overDueCount = Ticket::where('ticketOpenerCompanyId', $userCompanyId)
                ->whereDate('ticket.exp_end_date', '<=', $date)
                ->count();
            $pendingCount = Ticket::where('ticketOpenerCompanyId', $userCompanyId)
                ->where('ticketStatus', 'Pending')
                ->count();
            $closeCount = Ticket::where('ticketOpenerCompanyId', $userCompanyId)
                ->where('ticketStatus', 'Close')
                ->count();;
        }

        $teams = Team::all();
        $allEmp = User::where('fk_userTypeId', 3)->get();


        return view('Ticket.generate-excel')->with('openticket', $openCount)
                                                 ->with('overdue', $overDueCount)
                                                 ->with('pending', $pendingCount)
                                                 ->with('allticket', $allTicket)
                                                 ->with('teams', $teams)
                                                 ->with('allEmp', $allEmp)
                                                 ->with('close', $closeCount);


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
            $ticket->workedTimeType = $r->workTimeType;
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

    // ticket export
    public function ticketExport(Request $r){
        Excel::store(new TicketExport($r), 'tickets.xlsx');
    }

    // change mass ticket status
    public function changeMassTicketStatus(Request $r){
        $allTicket = Ticket::whereIn('ticketId', $r->allCheckedTicket)->update(['ticketStatus' => $r->ticketStatus]);
        return back();
    }

    // assign mass ticket to team
    public function assignTicketToTeam(Request $r)
    {
        $allTicket = Ticket::whereIn('ticketId', $r->allCheckedTicket)->update(['ticketAssignTeamId' => $r->teamid]);
        $allTicket = Ticket::whereIn('ticketId', $r->allCheckedTicket)->update(['ticketAssignPersonUserId' => null]);
        return back();
    }

    // assign mass ticket to team
    public function assignTicketToIndividual(Request $r)
    {
        $allTicket = Ticket::whereIn('ticketId', $r->allCheckedTicket)->update(['ticketAssignPersonUserId' => $r->empId]);
        $allTicket = Ticket::whereIn('ticketId', $r->allCheckedTicket)->update(['ticketAssignTeamId' => null]);
        return back();
    }

    // assign mass ticket to No one
    public function assignTicketToNoOne(Request $r)
    {
        $allTicket = Ticket::whereIn('ticketId', $r->allCheckedTicket)->update(['ticketAssignPersonUserId' => null]);
        $allTicket = Ticket::whereIn('ticketId', $r->allCheckedTicket)->update(['ticketAssignTeamId' => null]);
        return back();
    }


}
