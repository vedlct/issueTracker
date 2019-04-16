<?php

namespace App\Http\Controllers;

use App\Backlog;
use App\Bill;
use App\CableBill;
use App\CableClient;
use App\CheckMonth;
use App\Client;
use App\Employee;
use App\InternetBill;
use App\InternetClient;
use App\Report;
use App\Salary;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Ticket;
use App\Company;
use App\Project;
use Session;

class DashBoardController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth');
    }


    public function index()
    {
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


        if($userCompanyId == null)
        {
            $date = date('Y-m-d h:i:s');

            // all
            $allTicket= Ticket::all()->count();
            $openCount = Ticket::where('ticketStatus', 'Open')->count();
            $overDueCount = Ticket::whereDate('ticket.exp_end_date', '<=', $date)->where('ticketStatus', '!=', 'Close')->count();
            $pendingCount = Ticket::where('ticketStatus', 'Pending')->count();
            $closeCount = Ticket::where('ticketStatus', 'Close')->count();


            // Only for this month
            $currntYear = date("Y");
            $currntMonth = date("m");

            $allTicketMonth= Ticket::where(DB::raw('MONTH(created_at)'), $currntMonth)->where(DB::raw('YEAR(created_at)'), $currntYear)->count();
            $openCountMonth= Ticket::where('ticketStatus', 'Open')->where(DB::raw('MONTH(created_at)'), $currntMonth)->where(DB::raw('YEAR(created_at)'), $currntYear)->count();
            $overDueCountMonth = Ticket::whereDate('ticket.exp_end_date', '<=', $date)->where(DB::raw('MONTH(created_at)'), $currntMonth)->where(DB::raw('YEAR(created_at)'), $currntYear)->where('ticketStatus', '!=', 'Close')->count();
            $pendingCountMonth = Ticket::where('ticketStatus', 'Pending')->where(DB::raw('MONTH(created_at)'), $currntMonth)->where(DB::raw('YEAR(created_at)'), $currntYear)->count();
            $closeCountMonth = Ticket::where('ticketStatus', 'Close')->where(DB::raw('MONTH(created_at)'), $currntMonth)->where(DB::raw('YEAR(created_at)'), $currntYear)->count();

        }
        else
        {
            $date = date('Y-m-d h:i:s');

            $allTicket= Ticket::where('ticketOpenerCompanyId', $userCompanyId)
                              ->count();

            $openCount = Ticket::where('ticketOpenerCompanyId', $userCompanyId)
                               ->where('ticketStatus', 'Open')
                               ->count();

            $overDueCount = Ticket::where('ticketOpenerCompanyId', $userCompanyId)
                                  ->where('ticketStatus', '!=', 'Close')
                                  ->whereDate('ticket.exp_end_date', '<=', $date)
                                  ->count();

            $pendingCount = Ticket::where('ticketOpenerCompanyId', $userCompanyId)
                                  ->where('ticketStatus', 'Pending')
                                  ->count();

            $closeCount = Ticket::where('ticketOpenerCompanyId', $userCompanyId)
                                ->where('ticketStatus', 'Close')
                                ->count();

            // Only for this month
            $currntYear =  date("Y");
            $currntMonth = date("m");

            $allTicketMonth= Ticket::where(DB::raw('MONTH(created_at)'), $currntMonth)
                                    ->where(DB::raw('YEAR(created_at)'), $currntYear)
                                    ->where('ticketOpenerCompanyId', $userCompanyId)
                                    ->count();

            $openCountMonth= Ticket::where('ticketStatus', 'Open')
                                    ->where(DB::raw('MONTH(created_at)'), $currntMonth)
                                    ->where(DB::raw('YEAR(created_at)'), $currntYear)
                                    ->where('ticketOpenerCompanyId', $userCompanyId)
                                    ->count();

            $overDueCountMonth = Ticket::whereDate('ticket.exp_end_date', '<=', $date)
                                        ->where(DB::raw('MONTH(created_at)'), $currntMonth)
                                        ->where(DB::raw('YEAR(created_at)'), $currntYear)
                                        ->where('ticketStatus', '!=', 'Close')
                                        ->where('ticketOpenerCompanyId', $userCompanyId)
                                        ->count();

            $pendingCountMonth = Ticket::where('ticketStatus', 'Pending')
                                        ->where(DB::raw('MONTH(created_at)'), $currntMonth)
                                        ->where(DB::raw('YEAR(created_at)'), $currntYear)
                                        ->where('ticketOpenerCompanyId', $userCompanyId)
                                        ->count();

            $closeCountMonth = Ticket::where('ticketStatus', 'Close')
                                     ->where(DB::raw('MONTH(created_at)'), $currntMonth)
                                     ->where(DB::raw('YEAR(created_at)'), $currntYear)
                                     ->where('ticketOpenerCompanyId', $userCompanyId)
                                     ->count();

        }

        // Company
        $companyCount = Company::all()->count();

        // Project
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

        // only for super admin
        if($userCompanyId == null)
        {
            $projectCount = Project::all()->count();

            // CALCULATE PROJECT PERCENTAGE
            $projects = Project::all();
            $percentage_all = array();

            foreach ($projects as $project){
                $completedBacklog = Backlog::where('fk_project_id', $project->projectId)->where('backlog_state', 'complete')->count();
                $totalBacklog = Backlog::where('fk_project_id', $project->projectId)->count();;
                $percentage = ($completedBacklog*100)/$totalBacklog;
                $percentage_all[$project->project_name] = round($percentage);
            }
        }
        else
        {
            $projectCount = Project::where('fk_company_id', $userCompanyId)->count();

            // CALCULATE PROJECT PERCENTAGE
            $projects = Project::where('fk_company_id', $userCompanyId)->get();
            $percentage_all = array();

            foreach ($projects as $project){
                $completedBacklog = Backlog::where('fk_project_id', $project->projectId)->where('backlog_state', 'complete')->count();
                $totalBacklog = Backlog::where('fk_project_id', $project->projectId)->count();;
                $percentage = ($completedBacklog*100)/$totalBacklog;

                $percentage_all[$project->project_name] = round($percentage);
            }
            // END CALCULATE PROJECT PERCENTAGE
        }


        $mybacklogs = Backlog::leftJoin('backlog_assignment', 'backlog_assignment.fk_backlog_id', 'backlog.backlog_id')
            ->leftJoin('user', 'user.userId', 'backlog_assignment.fk_assigned_employee_user_id')
            ->leftJoin('project', 'project.projectId', 'backlog.fk_project_id')
            ->where('user.userId', Auth::user()->userId)
            ->whereDate('backlog_start_date', '<=', date('Y-m-d'))
            ->whereDate('backlog_end_date', '>=', date('Y-m-d'))
            ->where('backlog_state', '!=', 'Complete')
            ->where('backlog_state', '!=', 'Testing')
            ->get();

        $mybacklogsMissed = Backlog::leftJoin('backlog_assignment', 'backlog_assignment.fk_backlog_id', 'backlog.backlog_id')
            ->leftJoin('user', 'user.userId', 'backlog_assignment.fk_assigned_employee_user_id')
            ->leftJoin('project', 'project.projectId', 'backlog.fk_project_id')
            ->where('user.userId', Auth::user()->userId)
//            ->whereDate('backlog_start_date', '<=', date('Y-m-d'))
            ->whereDate('backlog_end_date', '<=', date('Y-m-d'))
            ->where('backlog_state', '!=', 'Complete')
            ->where('backlog_state', '!=', 'Testing')
            ->get();


        return view('index')->with('openticket', $openCount)
                                 ->with('overdue', $overDueCount)
                                 ->with('pending', $pendingCount)
                                 ->with('allticket', $allTicket)
                                 ->with('close', $closeCount)
                                 ->with('projectCount', $projectCount)
                                 ->with('companyCount', $companyCount)
                                 ->with('openticketMonth', $openCountMonth)
                                 ->with('overdueMonth', $overDueCountMonth)
                                 ->with('pendingMonth', $pendingCountMonth)
                                 ->with('allticketMonth', $allTicketMonth)
                                 ->with('closeMonth', $closeCountMonth)
                    ->with('mybacklogs', $mybacklogs)
                    ->with('mybacklogsMissed', $mybacklogsMissed)
                                 ->with('project_percentage', $percentage_all);
    }


    public function call_allticket()
    {
        Session::flash('call_ticket_type', 'allticket');
        return redirect()->route('ticket.showAllCTicket');
    }

    public function call_openticket()
    {
        Session::flash('call_ticket_type', 'open');
        return redirect()->route('ticket.showAllCTicket');
    }

    public function call_closeticket()
    {
        Session::flash('call_ticket_type', 'close');
        return redirect()->route('ticket.showAllCTicket');
    }

    public function call_overdueticket()
    {
        Session::flash('call_ticket_type', 'overdue');
        return redirect()->route('ticket.showAllCTicket');
    }

    public function call_pendingticket()
    {
        Session::flash('call_ticket_type', 'pending');
        return redirect()->route('ticket.showAllCTicket');
    }


}
