<?php

namespace App\Http\Controllers;

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
        }
        else
        {
            $projectCount = Project::where('fk_companyId', $userCompanyId)->count();
        }


        return view('index')->with('openticket', $openCount)
                                ->with('overdue', $overDueCount)
                                ->with('pending', $pendingCount)
                                ->with('allticket', $allTicket)
                                ->with('close', $closeCount)
                                ->with('projectCount', $projectCount)
                                ->with('companyCount', $companyCount);
    }



}
