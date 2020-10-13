<?php

namespace App\Http\Controllers;


use App\ClientContactPersonUserRelation;
use App\TicketType;


use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Session;
use App\Project;
use App\Ticket;
use App\Status;
use \Illuminate\Support\Facades\Auth;
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
    public function getCompanyUserId()
    {

        if (Auth::user()->fk_userTypeId == 2) {
            $this->user_company_id = ClientContactPersonUserRelation::where('person_userId', Auth::user()->userId)->first()->clientId;
        } elseif (Auth::user()->fk_userTypeId == 3 || Auth::user()->fk_userTypeId == 4 || Auth::user()->fk_userTypeId == 5) {
            $this->user_company_id = Auth::user()->fkCompanyId;
        }
//        if(Auth::user()->fk_userTypeId == 4)
//        {
////            $this->user_company_id = Auth::user()->fkCompanyId;
//            $this->user_company_id = Employee::where('employeeUserId', Auth::user()->userId)->first()->fk_companyId;
//        }
        if (Auth::user()->fk_userTypeId == 1) {
            $this->user_company_id = null;
        }

        return $this->user_company_id;
    }

//->orWhere('ticketOpenerCompanyId', Auth::user()->fkCompanyId)
    // view Ticket list
    public function index()
    {
        $userCompanyId = $this->getCompanyUserId();
        if (Auth::user()->fk_userTypeId == 2) {
            $client = ClientContactPersonUserRelation::where('person_userId', Auth::user()->userId)->first()->clientId;
            $Clientprojects = Project::where('fk_client_id', $client)->get();
        }
        if ($userCompanyId == null) {
            $date = date('Y-m-d h:i:s');
            $allTicket = Ticket::all()->count();
            $openCount = Ticket::where('ticketStatus', 'Open')->count();
            $overDueCount = Ticket::whereDate('ticket.exp_end_date', '<=', $date)->where('ticketStatus', '!=', 'Close')->count();
            $pendingCount = Ticket::where('ticketStatus', 'Pending')->count();
            $closeCount = Ticket::where('ticketStatus', 'Close')->count();;
        } else {
            $date = date('Y-m-d h:i:s');

            $openCount = Ticket::where('ticketStatus', 'Open');
            $overDueCount = Ticket::whereDate('ticket.exp_end_date', '<=', $date)->where('ticket.ticketStatus', '!=', 'Close');
            $pendingCount = Ticket::where('ticketStatus', 'Pending');
            $closeCount = Ticket::where('ticketStatus', 'Close');
            $myCount = Ticket::where('fk_ticketOpenerId', Auth::user()->userId)->get();

            if (Auth::user()->fk_userTypeId == 2) {
                $allTicket = Ticket::where(function ($query) use ($Clientprojects) {
                    foreach ($Clientprojects as $project) {
                        $query->orWhere('fk_projectId', $project->projectId);
                    }
                })->orWhere('fk_ticketOpenerId', Auth::user()->userId)->count();

                $openCount = Ticket::where(function ($query) use ($Clientprojects) {
                    foreach ($Clientprojects as $project) {
                        $query->orWhere('fk_projectId', $project->projectId)->where('ticketStatus', 'Open');
                    }
                })->orWhere('fk_ticketOpenerId', Auth::user()->userId)->where('ticketStatus', 'Open');

                $closeCount = Ticket::where(function ($query) use ($Clientprojects) {
                    foreach ($Clientprojects as $project) {
                        $query->orWhere('fk_projectId', $project->projectId)->where('ticketStatus', 'Close');
                    }
                })->orWhere('fk_ticketOpenerId', Auth::user()->userId)->where('ticketStatus', 'Close');

                $pendingCount = Ticket::where(function ($query) use ($Clientprojects) {
                    foreach ($Clientprojects as $project) {
                        $query->orWhere('fk_projectId', $project->projectId)->where('ticketStatus', 'Pending');
                    }
                })->orWhere('fk_ticketOpenerId', Auth::user()->userId)->where('ticketStatus', 'Pending');

                $overDueCount = Ticket::where(function ($query) use ($Clientprojects) {
                    $date = date('Y-m-d h:i:s');
                    foreach ($Clientprojects as $project) {
                        $query->orWhere('fk_projectId', $project->projectId)->where('ticketStatus', '!=', 'Close')->whereDate('ticket.exp_end_date', '<=', $date);
                    }
                })->orWhere('fk_ticketOpenerId', Auth::user()->userId)->where('ticketStatus', '!=', 'Close')->whereDate('ticket.exp_end_date', '<=', $date);

                /* $allTicket = Ticket::where(function ($query) use ($projects) {
                     foreach ($projects as $project) {
                         $query->orWhere('fk_projectId', $project->projectId);
                     }
                 })->orWhere('fk_ticketOpenerId', Auth::user()->userId)->count();

                 $openCount = $openCount->where(function ($query) use ($projects) {
                     foreach ($projects as $project) {
                         $query->orWhere('fk_projectId', $project->projectId);
                     }
                 })->orWhere('fk_ticketOpenerId', Auth::user()->userId);

                 $overDueCount = $overDueCount->where(function ($query) use ($projects) {
                     foreach ($projects as $project) {
                         $query->orWhere('fk_projectId', $project->projectId);
                     }
                 })->orWhere('fk_ticketOpenerId', Auth::user()->userId);
                 $pendingCount = $pendingCount->where('fk_ticketOpenerId', Auth::user()->userId);
                 $closeCount = $closeCount->where('fk_ticketOpenerId', Auth::user()->userId);*/

            } else {
                $allTicket = Ticket::where('ticketOpenerCompanyId', $userCompanyId)->count();
                $openCount = $openCount->where('ticketOpenerCompanyId', $userCompanyId);
                $overDueCount = $overDueCount->where('ticketOpenerCompanyId', $userCompanyId);
                $pendingCount = $pendingCount->where('ticketOpenerCompanyId', $userCompanyId);
                $closeCount = $closeCount->where('ticketOpenerCompanyId', $userCompanyId);

            }
//            $allTicket = $allTicket->count();
            $openCount = $openCount->count();
            $overDueCount = $overDueCount->count();
            $pendingCount = $pendingCount->count();
            $closeCount = $closeCount->count();
        }

        if ($userCompanyId == null) {
            $teams = Team::all();
            $allEmp = User::where('fk_userTypeId', 3)->get();
        } else {
            $teams = Team::where('fk_companyId', $userCompanyId)->get();
            $allEmp = User::leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')->where('companyemployee.fk_companyId', $userCompanyId)->where('user.fk_userTypeId', 3)->get();
        }

        return view('Ticket.ticketList')->with('openticket', $openCount)
            ->with('myTicket', $myCount)
            ->with('overdue', $overDueCount)
            ->with('pending', $pendingCount)
            ->with('allticket', $allTicket)
            ->with('teams', $teams)
            ->with('allEmp', $allEmp)
            ->with('close', $closeCount);
    }

//    Specific client ticket
    public function myTicket(){
        return view('Ticket.myTicketList');
    }

    public function getMyAllTicket(Request $r)
    {
        $tickets = Ticket::where('fk_ticketOpenerId', Auth::user()->userId)->get();
        $datatables = Datatables::of($tickets);
        return $datatables->make(true);
    }

    // view Ticket info
    public function showTicket($id)
    {
        if (!Auth::check()) {

            return redirect()->route('login')->with('ticket_id');

        } else {
            $ticket = Ticket::select('ticket.*', 'user.fullName', 'team.teamName')
                ->Join('user', 'ticket.fk_ticketOpenerId', 'user.userId')
                ->leftJoin('team', 'team.teamId', 'ticket.ticketAssignTeamId')
                ->findOrFail($id);
            $assignedPerson = User::Join('ticket', 'ticket.ticketAssignPersonUserId', 'user.userId')->where('ticket.ticketId', $id)->first();

            $teamid = Ticket::findOrFail($id);

            $teamMembers = User::Join('assignteam_new', 'assignteam_new.fk_userId', 'user.userId')
                ->where('assignteam_new.fkteamId', $teamid->ticketAssignTeamId)->get();

            $ticketReplies = TicketReply::select('user.fullName', 'ticketreply.*')
                ->where('fk_ticketId', $id)
                ->Join('user', 'ticketreply.fk_userId', 'user.userId')->orderBy('created_at', 'DESC')->get();

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
    public function getAllTicket(Request $r)
    {
        if (Auth::user()->fk_userTypeId == 2) {
            $client = ClientContactPersonUserRelation::where('person_userId', Auth::user()->userId)->first()->clientId;
            $Clientprojects = Project::where('fk_client_id', $client)->get();
        }
        // Get user's company ID
        $userCompanyId = $this->getCompanyUserId();

        // get all ticket of user's company if ticketTye is not null
        if ($r->ticketType != null) {
            // only for super admin
            if ($userCompanyId == null) {
                if ($r->overDue == "overdue") {
                    $date = date('Y-m-d h:i:s');
                    $tickets = Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"), 'ticket.*', 'createdUser.fullName as createdFullName', 'assignUser.fullName as assignFullName', 'project.*')
                        ->leftJoin('project', 'project.projectId', 'ticket.fk_projectId')
                        ->leftJoin('user as createdUser', 'createdUser.userId', 'ticket.fk_ticketOpenerId')
                        ->leftJoin('user as assignUser', 'assignUser.userId', 'ticket.ticketAssignPersonUserId')
                        ->leftJoin('assignteam_new', 'assignteam_new.fkteamId', 'ticket.ticketAssignTeamId')
                        ->leftJoin('user', 'user.userId', 'assignteam_new.fk_userId')
                        ->whereDate('ticket.exp_end_date', '<=', $date)
                        ->where('ticket.ticketStatus', '!=', 'Close')
                        ->groupBy('ticket.ticketId');
                } elseif ($r->allTicket == "all") {
                    $tickets = Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"), 'ticket.*', 'createdUser.fullName as createdFullName', 'assignUser.fullName as assignFullName', 'project.*')
                        ->leftJoin('project', 'project.projectId', 'ticket.fk_projectId')
                        ->leftJoin('user as createdUser', 'createdUser.userId', 'ticket.fk_ticketOpenerId')
                        ->leftJoin('user as assignUser', 'assignUser.userId', 'ticket.ticketAssignPersonUserId')
                        ->leftJoin('assignteam_new', 'assignteam_new.fkteamId', 'ticket.ticketAssignTeamId')
                        ->leftJoin('user', 'user.userId', 'assignteam_new.fk_userId')
                        ->groupBy('ticket.ticketId');
                } else {
                    $tickets = Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"), 'ticket.*', 'createdUser.fullName as createdFullName', 'assignUser.fullName as assignFullName', 'project.*')
                        ->leftJoin('project', 'project.projectId', 'ticket.fk_projectId')
                        ->leftJoin('user as createdUser', 'createdUser.userId', 'ticket.fk_ticketOpenerId')
                        ->leftJoin('user as assignUser', 'assignUser.userId', 'ticket.ticketAssignPersonUserId')
                        ->leftJoin('assignteam_new', 'assignteam_new.fkteamId', 'ticket.ticketAssignTeamId')
                        ->leftJoin('user', 'user.userId', 'assignteam_new.fk_userId')
                        ->where('ticket.ticketStatus', $r->ticketType)
                        ->groupBy('ticket.ticketId');
                }
            } // other user
            else {
                if ($r->overDue == "overdue") {
                    $date = date('Y-m-d h:i:s');
                    $tickets = Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"), 'ticket.*', 'createdUser.fullName as createdFullName', 'assignUser.fullName as assignFullName', 'project.*')
                        ->leftJoin('project', 'project.projectId', 'ticket.fk_projectId')
                        ->leftJoin('user as createdUser', 'createdUser.userId', 'ticket.fk_ticketOpenerId')
                        ->leftJoin('user as assignUser', 'assignUser.userId', 'ticket.ticketAssignPersonUserId')
                        ->leftJoin('assignteam_new', 'assignteam_new.fkteamId', 'ticket.ticketAssignTeamId')
                        ->leftJoin('user', 'user.userId', 'assignteam_new.fk_userId')
                        ->groupBy('ticket.ticketId');

                    if (Auth::user()->fk_userTypeId == 2) {

                        $tickets = $tickets->where(function ($query) use ($Clientprojects) {
                            $date = date('Y-m-d h:i:s');

                            foreach ($Clientprojects as $project) {
                                $query->orWhere('fk_projectId', $project->projectId)->where('ticketStatus', '!=', 'Close')->whereDate('ticket.exp_end_date', '<=', $date);
                            }
                        })/*->orWhere('fk_ticketOpenerId', Auth::user()->userId)->where('ticketStatus', '!=', 'Close')->whereDate('ticket.exp_end_date', '<=', $date)*/;

                    } else {
                        $tickets = $tickets->where('ticket.ticketOpenerCompanyId', $userCompanyId);
                    }
                    $tickets = $tickets->whereDate('ticket.exp_end_date', '<=', $date)
                        ->where('ticket.ticketStatus', '!=', 'Close')
                        ->groupBy('ticket.ticketId');
                } elseif ($r->allTicket == "all") {
                    $tickets = Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"), 'ticket.*', 'createdUser.fullName as createdFullName', 'assignUser.fullName as assignFullName', 'project.*')
                        ->leftJoin('project', 'project.projectId', 'ticket.fk_projectId')
                        ->leftJoin('user as createdUser', 'createdUser.userId', 'ticket.fk_ticketOpenerId')
                        ->leftJoin('user as assignUser', 'assignUser.userId', 'ticket.ticketAssignPersonUserId')
                        ->leftJoin('assignteam_new', 'assignteam_new.fkteamId', 'ticket.ticketAssignTeamId')
                        ->leftJoin('user', 'user.userId', 'assignteam_new.fk_userId')
                        ->groupBy('ticket.ticketId');

                    if (Auth::user()->fk_userTypeId == 2) {

                        $tickets = $tickets->where(function ($query) use ($Clientprojects) {
                            foreach ($Clientprojects as $project) {
                                $query->orWhere('fk_projectId', $project->projectId);
                            }
                        })/*->orWhere('fk_ticketOpenerId', Auth::user()->userId)*/;
                    } else {
                        $tickets = $tickets->where('ticket.ticketOpenerCompanyId', $userCompanyId);
                    }
                    $tickets = $tickets->groupBy('ticket.ticketId');
                } elseif ($r->allTicket == "pending") {
                    $tickets = Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"), 'ticket.*', 'createdUser.fullName as createdFullName', 'assignUser.fullName as assignFullName', 'project.*')
                        ->leftJoin('project', 'project.projectId', 'ticket.fk_projectId')
                        ->leftJoin('user as createdUser', 'createdUser.userId', 'ticket.fk_ticketOpenerId')
                        ->leftJoin('user as assignUser', 'assignUser.userId', 'ticket.ticketAssignPersonUserId')
                        ->leftJoin('assignteam_new', 'assignteam_new.fkteamId', 'ticket.ticketAssignTeamId')
                        ->leftJoin('user', 'user.userId', 'assignteam_new.fk_userId')
                        ->groupBy('ticket.ticketId');

                    if (Auth::user()->fk_userTypeId == 2) {

                        $tickets = $tickets->where(function ($query) use ($Clientprojects) {
                            foreach ($Clientprojects as $project) {
                                $query->orWhere('fk_projectId', $project->projectId)->where('ticketStatus', 'Pending');
                            }
                        })->orWhere('fk_ticketOpenerId', Auth::user()->userId)->where('ticketStatus', 'Pending');
                    } else {
                        $tickets = $tickets->where('ticket.ticketOpenerCompanyId', $userCompanyId);
                    }
                    $tickets = $tickets->groupBy('ticket.ticketId');
                }

                elseif ($r->allTicket == "open") {
                    $tickets = Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"), 'ticket.*', 'createdUser.fullName as createdFullName', 'assignUser.fullName as assignFullName', 'project.*')
                        ->leftJoin('project', 'project.projectId', 'ticket.fk_projectId')
                        ->leftJoin('user as createdUser', 'createdUser.userId', 'ticket.fk_ticketOpenerId')
                        ->leftJoin('user as assignUser', 'assignUser.userId', 'ticket.ticketAssignPersonUserId')
                        ->leftJoin('assignteam_new', 'assignteam_new.fkteamId', 'ticket.ticketAssignTeamId')
                        ->leftJoin('user', 'user.userId', 'assignteam_new.fk_userId')
                        ->groupBy('ticket.ticketId');

                    if (Auth::user()->fk_userTypeId == 2) {
                        $tickets = $tickets->where(function ($query) use ($Clientprojects) {
                            foreach ($Clientprojects as $project) {
                                $query->orWhere('fk_projectId', $project->projectId)->where('ticketStatus', 'Open');
                            }
                        })/*->orWhere('fk_ticketOpenerId', Auth::user()->userId)->where('ticketStatus', 'Open')*/;

                    } else {
                        $tickets = $tickets->where('ticket.ticketOpenerCompanyId', $userCompanyId);
                    }
                    $tickets = $tickets->groupBy('ticket.ticketId');
                }

                elseif ($r->allTicket == "close") {
                    $tickets = Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"), 'ticket.*', 'createdUser.fullName as createdFullName', 'assignUser.fullName as assignFullName', 'project.*')
                        ->leftJoin('project', 'project.projectId', 'ticket.fk_projectId')
                        ->leftJoin('user as createdUser', 'createdUser.userId', 'ticket.fk_ticketOpenerId')
                        ->leftJoin('user as assignUser', 'assignUser.userId', 'ticket.ticketAssignPersonUserId')
                        ->leftJoin('assignteam_new', 'assignteam_new.fkteamId', 'ticket.ticketAssignTeamId')
                        ->leftJoin('user', 'user.userId', 'assignteam_new.fk_userId')
                        ->groupBy('ticket.ticketId');

                    if (Auth::user()->fk_userTypeId == 2) {

                        $tickets = $tickets->where(function ($query) use ($Clientprojects) {
                            foreach ($Clientprojects as $project) {
                                $query->orWhere('fk_projectId', $project->projectId)->where('ticketStatus', 'Close');
                            }
                        })/*->orWhere('fk_ticketOpenerId', Auth::user()->userId)->where('ticketStatus', 'Close')*/;
                    } else {
                        $tickets = $tickets->where('ticket.ticketOpenerCompanyId', $userCompanyId);
                    }
                    $tickets = $tickets->groupBy('ticket.ticketId');
                }

                else {
                    $tickets = Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"), 'ticket.*', 'createdUser.fullName as createdFullName', 'assignUser.fullName as assignFullName', 'project.*')
                        ->leftJoin('project', 'project.projectId', 'ticket.fk_projectId')
                        ->leftJoin('user as createdUser', 'createdUser.userId', 'ticket.fk_ticketOpenerId')
                        ->leftJoin('user as assignUser', 'assignUser.userId', 'ticket.ticketAssignPersonUserId')
                        ->leftJoin('assignteam_new', 'assignteam_new.fkteamId', 'ticket.ticketAssignTeamId')
                        ->leftJoin('user', 'user.userId', 'assignteam_new.fk_userId');
                    /*if (Auth::user()->fk_userTypeId == 2) {

                        $tickets = $tickets->where(function ($query) use ($Clientprojects) {
                            foreach ($Clientprojects as $project) {
                                $query->orWhere('fk_projectId', $project->projectId);
                            }
                        })->orWhere('fk_ticketOpenerId', Auth::user()->userId);
                    } else {*/
                        $tickets = $tickets->where('ticket.ticketOpenerCompanyId', $userCompanyId);
//                    }
                    $tickets = $tickets->where('ticket.ticketStatus', $r->ticketType)
                        ->groupBy('ticket.ticketId');
                }
            }
        } // get all ticket of user's company if ticket type is null
        else {
            if ($userCompanyId == null) {
                $tickets = Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"), 'ticket.*', 'createdUser.fullName as createdFullName', 'assignUser.fullName as assignFullName', 'project.*')
                    ->leftJoin('project', 'project.projectId', 'ticket.fk_projectId')
                    ->leftJoin('user as createdUser', 'createdUser.userId', 'ticket.fk_ticketOpenerId')
                    ->leftJoin('user as assignUser', 'assignUser.userId', 'ticket.ticketAssignPersonUserId')
                    ->leftJoin('assignteam_new', 'assignteam_new.fkteamId', 'ticket.ticketAssignTeamId')
                    ->leftJoin('user', 'user.userId', 'assignteam_new.fk_userId')
                    ->groupBy('ticket.ticketId');
            } else {
                $tickets = Ticket::select(DB::raw("GROUP_CONCAT(user.fullName) as assignTeamMembers"), 'ticket.*', 'createdUser.fullName as createdFullName', 'assignUser.fullName as assignFullName', 'project.*')
                    ->leftJoin('project', 'project.projectId', 'ticket.fk_projectId')
                    ->leftJoin('user as createdUser', 'createdUser.userId', 'ticket.fk_ticketOpenerId')
                    ->leftJoin('user as assignUser', 'assignUser.userId', 'ticket.ticketAssignPersonUserId')
                    ->leftJoin('assignteam_new', 'assignteam_new.fkteamId', 'ticket.ticketAssignTeamId')
                    ->leftJoin('user', 'user.userId', 'assignteam_new.fk_userId')
                    ->groupBy('ticket.ticketId');
                if (Auth::user()->fk_userTypeId == 2) {

                    $tickets = $tickets->where(function ($query) use ($Clientprojects) {
                        foreach ($Clientprojects as $project) {
                            $query->orWhere('fk_projectId', $project->projectId);
                        }
                    })/*->orWhere('fk_ticketOpenerId', Auth::user()->userId)*/;
                } else {
                    $tickets = $tickets->where('ticket.ticketOpenerCompanyId', $userCompanyId);
                }
//                $tickets = $tickets->groupBy('ticket.ticketId');
            }
        }


        // filter
        if ($r->startDate) {
            $tickets = $tickets->whereDate('ticket.created_at', '>=', $r->startDate);
        }
        if ($r->endDate) {
            $tickets = $tickets->whereDate('ticket.created_at', '<=', $r->endDate);
        }
        if ($r->ticketStatus) {
            $tickets = $tickets->where('ticket.ticketStatus', $r->ticketStatus);
        }

//        $tickets = $tickets->orderBy('ticket.ticketId', 'desc');


        $datatables = Datatables::of($tickets);
        return $datatables->make(true);
    }

    // view create ticket
    public function createTicket()
    {

        // Get user's company ID
        $userCompanyId = $this->getCompanyUserId();
        $ticketType = TicketType::get();

        // get all project of user's company
        if ($userCompanyId == null) {
            $projectlist = Project::all();
        } else {
            if (Auth::user()->fk_userTypeId == 4 || Auth::user()->fk_userTypeId == 5 || Auth::user()->fk_userTypeId == 3) {
                $projectlist = Project::where('fk_company_id', $userCompanyId)->get();
            } else {
                $projectlist = Project::where('fk_client_id', $userCompanyId)->get();
            }
        }

        return view('Ticket.createTicket')
            ->with('projectlist', $projectlist)
            ->with('tickettype', $ticketType);

    }

    // insert ticket
    public function insertTicket(Request $r)
    {

        // Get user's company ID
        $userCompanyId = $this->getCompanyUserId();

//        dd($userCompanyId);

        if ($userCompanyId != null) {
            // get all client's company's all employee user_id
            $allEmp = Employee::where('fk_companyId', $userCompanyId)->get();

            $array = array();

            foreach ($allEmp as $emp) {
                array_push($array, $emp->employeeUserId);
            }

//            $allEmployeeEmails = User::whereIn('userId', $array)
//                                     ->select('email')->get();
//
            $array1 = array();
//            foreach ($allEmployeeEmails as $emp)
//            {
//                array_push($array1, $emp->email);
//            }


            $clientId = Project::findOrFail($r->project)->fk_client_id;
            $client_contact_person = ClientContactPersonUserRelation::where('clientId', $clientId)->get();

            $array = array();

            foreach ($client_contact_person as $client) {
                array_push($array, $client->person_userId);
            }

            $allClientEmails = User::whereIn('userId', $array)->select('email')->get();

            foreach ($allClientEmails as $client) {
                array_push($array1, $client->email);
            }
        } else {
            Session::flash('error_msg', 'Super admin cant create ticket!');

            return back();
        }


        $ticketStatus = Status::where('statusId', '3')->first();

        $date = date('Y-m-d h:i:s');
        $ticket = new Ticket();
        $ticket->ticketTopic = $r->topic;
        $ticket->ticketStatus = $ticketStatus->statusData;
        $ticket->ticketDetails = $r->details;
        $ticket->created_at = date('Y-m-d');
        $ticket->lastUpdated = $date;
        $ticket->ticketPriority = $r->priroty;
        $ticket->exp_end_date = Carbon::parse($r->exp_end_date)->format('Y-m-d');
        $ticket->fk_projectId = $r->project;
        $ticket->fkTicketTypeId = $r->tickettype;
        $ticket->fk_ticketOpenerId = Auth::user()->userId;


        if (Auth::user()->fk_userTypeId == 2) {
//            $cliendId = $this->getCompanyUserId();
//            $ticketOpenerCompany = Client::findOrFail($cliendId)->first()->clientCompanyId;
//            $companyId = $ticketOpenerCompany;
            $ticket->ticketOpenerCompanyId = Auth::user()->fkCompanyId;
        }
        if (Auth::user()->fk_userTypeId == 3) {
//            $ticketOpenerCompany = Employee::where('employeeUserId', Auth::user()->userId)->first();
//            $companyId = $ticketOpenerCompany->fk_companyId;

            $ticket->ticketOpenerCompanyId = $userCompanyId;
        }
        if (Auth::user()->fk_userTypeId == 4) {
//            $ticketOpenerCompany = Employee::where('employeeUserId', Auth::user()->userId)->first();
//            $companyId = $ticketOpenerCompany->fk_companyId;

            $ticket->ticketOpenerCompanyId = $userCompanyId;
        }
        if (Auth::user()->fk_userTypeId == 1) {
            $ticket->ticketOpenerCompanyId = null;
        }

        $ticket->save();

        // set ticket number
        $ticket_no = mt_rand(100000, 999999);
        $ticket_no_i = Ticket::where('ticket_number', $ticket_no)->get();

        while (count($ticket_no_i) > 0) {
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
            $ticket->ticketFile = $fileName;
            $ticket->save();
        }
        // set ticket number end

        // set mailing information
        $ticketOpenerName = Auth::user()->fullName;
        $priority = $r->priroty;
        $details = $r->details;

        //  $projectName = Project::where('projectId', $r->project)->first()->project_name;

//        $cliendId = $this->getCompanyUserId();
//        $ticketOpenerCompany = Client::findOrFail($cliendId)->first()->clientCompanyId;
//        $companyId = $ticketOpenerCompany;

        $company_admin_mail = User::leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')
            ->where('user.fk_userTypeId', 4)
            ->where('companyemployee.fk_companyId', Auth::user()->fkCompanyId)
            ->first()->email;

        $data = array(
            'name' => 'Arabi Kabir',
            'email' => $company_admin_mail,
            'message' => 'New Ticket is created',
            'ticketOpenerName' => $ticketOpenerName,
            'priority' => $priority,
            'details' => $details,
            'ticketNo' => $ticket_no,
            'ticketId' => $ticket->ticketId,
            'ticketTopic' => $ticket->ticketTopic,
        );

//        Mail::send('Ticket.mailView', $data, function($message) use ($data, $array1)
//        {
//            $message->to($data['email'], 'Company Admin')
//                    ->cc($array1)
//                    ->subject('New Ticket Created');
//        });
        // End Send Mail
        $froMail = User::select('email', 'fk_userTypeId')->where('fkCompanyId', Auth::user()->fkCompanyId)->whereIn('fk_userTypeId', [5, 4])->get();
        if (count($froMail) > 0) {
            $address = $froMail->where('fk_userTypeId', 4)->first()->email;
            $mailAddresses = [];
            foreach ($froMail as $mailAddress) {
                if ($mailAddress->email != $address) {
                    $mailAddresses[] = $mailAddress->email;
                }
            }

            Mail::send('Ticket.mailView', $data, function ($message) use ($mailAddresses, $address) {
                $message->to($address, 'Admin')
                    ->cc($mailAddresses)
                    ->subject('New Ticket Created');
            });
        }


        Session::flash('message', 'Ticket Created!');

        return back();
    }


    // return ck editor view
    public function returnCkEditorView(Request $r)
    {
        $ticket = Ticket::findOrFail($r->id);
        return view('Ticket.ckEditorView')->with('ticket', $ticket);
    }


    // update ticket details
    public function updateTicketDetails(Request $r)
    {
        $ticket = Ticket::findOrFail($r->ticket_id);
        $ticket->ticketDetails = $r->details;
        $ticket->save();

        Session::flash('message', 'Ticket Updated!');

        return back();
    }

    // insert ticket reply
    public function insertReply(Request $r)
    {
        $userCompanyId = $this->getCompanyUserId();

        // get all email of user's company
        if ($userCompanyId != null) {
            // get ticket opener email
            $array1 = array();
            $ticketDetails = Ticket::where('ticketId', $r->ticketId)->first();
            $ticketopenerId = $ticketDetails->fk_ticketOpenerId;
            $ticketAssignPersonUserId = $ticketDetails->ticketAssignPersonUserId;
            $ticketTopic = $ticketDetails->ticketTopic;
            $ticketId = $ticketDetails->ticket_number;
            $ticketOpener = User::where('userId', $ticketopenerId)->first()->fullName;
            $userId = User::where('userId', $ticketopenerId)->first()->email;
            array_push($array1, $userId);

            // get company admin email

            // get all client's company's all employee user_id
//            $allEmp = Employee::where('fk_companyId', $userCompanyId)->get();
//
//            $array = array();
//
//            foreach ($allEmp as $emp)
//            {
//                array_push($array, $emp->employeeUserId);
//            }
//
//            $allEmployeeEmails = User::whereIn('userId', $array)->where('fk_userTypeId', 4)->select('email')->get();
//
//            foreach ($allEmployeeEmails as $emp)
//            {
//                array_push($array1, $emp->email);
//            }
        } else {
            Session::flash('error_msg', 'Super admin cant reply on ticket!');

            return back();
        }

        $company_admin_mail = User::leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')
            ->where('user.fk_userTypeId', 4)
            ->orWhere('user.fk_userTypeId', 2)
            ->where('companyemployee.fk_companyId', $userCompanyId)
            ->first()->email;

        $data = array(
            'name' => 'Issuetracker',
            'email' => $company_admin_mail,
            'message' => strip_tags($r->replyData),
            'reply_user' => Auth::user()->fullName,
            'reply' => strip_tags($r->replyData),
            'ticketOpner' => $ticketOpener,
            'ticketTopic' => $ticketTopic,
            'ticketNo' => $ticketId,
            'ticketId' => $r->ticketId,
        );


//        Mail::send('Ticket.replyMailView', $data, function($message) use ($data,$array1)
//        {
//            $message->to($data['email'], 'Ticket Reply Mail')
//                    ->cc($array1)
//                    ->subject('New Ticket Reply');
//        });

        $froMail = User::select('email', 'fk_userTypeId')->where('fkCompanyId', Auth::user()->fkCompanyId)->whereIn('fk_userTypeId', [5, 4])->get();
        if (count($froMail) > 0) {
            $address = $froMail->where('fk_userTypeId', 4)->first()->email;
            $mailAddresses = [];
            $mailAddresses[] = Auth::user()->email;
            $related = User::whereIn('userId', [$ticketopenerId, $ticketAssignPersonUserId])->get();
            foreach ($related as $relatedMail) {
                $mailAddresses[] = $relatedMail->email;
            }
            foreach ($froMail as $mailAddress) {
                if ($mailAddress->email != $address) {
                    $mailAddresses[] = $mailAddress->email;
                }
            }

            Mail::send('Ticket.replyMailView', $data, function ($message) use ($mailAddresses, $address) {
                $message->to($address, 'Ticket Reply Mail')
                    ->cc($mailAddresses)
                    ->subject('New Ticket Reply');
            });
        }

        $time = date('Y-m-d h:i:s');

        $ticketReply = new TicketReply();
        $ticketReply->replyData = strip_tags($r->replyData);
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
            $ticketReply->ticketReplyFile = $fileName;
            $ticketReply->save();
        }

        Session::flash('message', 'Reply Sent!');

        return back();
    }

    // show ticket edit
    public function ticketEdit(Request $r)
    {
        $froMail = User::select('email', 'fk_userTypeId')->where('fkCompanyId', Auth::user()->fkCompanyId)->whereIn('fk_userTypeId', [5, 4, 2])->get();
        // Get user's company ID
        $userCompanyId = $this->getCompanyUserId();


        if ($userCompanyId == null) {
            $teams = Team::all();
            $employee = DB::table('user')->where('fk_userTypeId', 3)->get();
        } else {
            $teams = Team::where('fk_companyId', $userCompanyId)->get();

            $employee = DB::table('user')->leftJoin('companyemployee', 'user.userId', 'companyemployee.employeeUserId')
                ->whereIn('user.fk_userTypeId', [3, 5])
                ->where('companyemployee.fk_companyId', $userCompanyId)
                ->get();
        }


        $ticket = Ticket::findOrFail($r->id);
        $ticket_reply = TicketReply::where('fk_ticketId', $ticket->ticketId)->get();
        return view('Ticket.ticketEdit')->with('ticket', $ticket)
            ->with('employeeList', $employee)
            ->with('teams', $teams)
            ->with('froMail', $froMail)
            ->with('ticket_reply', $ticket_reply);
    }

    // show generate excel page
    public function showGenerateExcel()
    {

        // Get user's company ID
        $userCompanyId = $this->getCompanyUserId();


        if ($userCompanyId == null) {
            $date = date('Y-m-d h:i:s');


            $allTicket = Ticket::all()->count();
            $openCount = Ticket::where('ticketStatus', 'Open')
                ->count();
            $overDueCount = Ticket::whereDate('ticket.exp_end_date', '<=', $date)
                ->where('ticketStatus', '!=', 'Close')
                ->count();
            $pendingCount = Ticket::where('ticketStatus', 'Pending')
                ->count();
            $closeCount = Ticket::where('ticketStatus', 'Close')
                ->count();;
        } else {
            $date = date('Y-m-d h:i:s');

            $allTicket = Ticket::where('ticketOpenerCompanyId', $userCompanyId)->count();

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
    public function updateTicketMain(Request $r)
    {
        $time = date('Y-m-d h:i:s');

        $ticket = Ticket::where('ticketId', $r->ticketId)->first();

        if ($r->workedHour == null) {
            $ticket->workedHour = null;
        } else {
            $ticket->workedHour = $r->workedHour;
            $ticket->workedTimeType = $r->workTimeType;
        }

        if ($r->ticketStatus == 'Close') {

            $userCompanyId = $this->getCompanyUserId();
//            $ticketDetails = Ticket::where('ticketId', $r->ticketId)->first();
            $ticketTopic = $ticket->ticketTopic;
            $ticketId = $ticket->ticket_number;

            $company_admin_mail = User::leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')
                ->where('user.fk_userTypeId', 4)
                ->orWhere('user.fk_userTypeId', 2)
                ->where('companyemployee.fk_companyId', $userCompanyId)
                ->first()->email;
            $data = array(
                'name' => 'Issuetracker',
                'email' => $company_admin_mail,
                'personal_note' => $r->personal_note,
                'ticketTopic' => $ticketTopic,
                'ticketNo' => $ticketId,
                'ticketId' => $r->ticketId,
            );

            $mailAddresses = $r->email;

            Mail::send('Ticket.closeMailView', $data, function ($message) use ($mailAddresses) {
                $message->to($mailAddresses, 'Ticket Close Mail')
                    ->subject('Ticket Close');
            });
            $ticket->ticketStatus = $r->ticketStatus;

        } else {
            $ticket->ticketStatus = $r->ticketStatus;
        }
        $ticket->ticketStatus = $r->ticketStatus;
        $ticket->end_at = $time;

        if ($r->assignType == 'single') {
            $ticket->ticketAssignPersonUserId = $r->assignPersonId;
            $ticket->ticketAssignTeamId = null;
        } else {
            $ticket->ticketAssignTeamId = $r->teamId;
            $ticket->ticketAssignPersonUserId = null;
        }

        $ticket->save();

        Session::flash('message', 'Ticket Updated!');

        return back();
    }

    // ticket export
    public function ticketExport(Request $r)
    {
        Excel::store(new TicketExport($r), 'tickets.xlsx');
    }

    // change mass ticket status
    public function changeMassTicketStatus(Request $r)
    {
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
