<?php

namespace App\Http\Controllers;

use App\Backlog;
use App\Bill;
use App\CableBill;
use App\CableClient;
use App\CheckMonth;
use App\Client;
use App\ClientContactPersonUserRelation;
use App\ClientProjectRelation;
use App\Employee;
use App\InternetBill;
use App\InternetClient;
use App\Notification;
use App\ProjectPartner;
use App\Report;
use App\Salary;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function changeCompany(Request $r){
        User::where('userId',Auth::user()->userId)->update(['fkCompanyId'=>$r->id]);
    }
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
            $this->user_company_id = Employee::where('employeeUserId', Auth::user()->userId)->first()->fk_companyId;
        }
        if(Auth::user()->fk_userTypeId == 1)
        {
            $this->user_company_id = null;
        }

        return $this->user_company_id;
    }

    public function clientDashboard()
    {
        $date = date('Y-m-d h:i:s');

            $clientId = ClientContactPersonUserRelation::where('person_userId', Auth::user()->userId)->first()->clientId;
//            dd($clientId);
            $projectCount= Project::where('fk_client_id', $clientId)->count();

            // CALCULATE PROJECT PERCENTAGE
            $projects = Project::where('fk_client_id', $clientId)->where('project_status', '!=' ,6)->get();
            $percentage_all = array();

            foreach ($projects as $project){
                $completedBacklog = Backlog::where('fk_project_id', $project->projectId)->where('backlog_state', 'complete')->count();
                $totalBacklog = Backlog::where('fk_project_id', $project->projectId)->count();
                if($totalBacklog == 0)
                {
                    $percentage = 0;
                }
                else
                {
                    $percentage = ($completedBacklog*100)/$totalBacklog;
                }
                $percentage_all[$project->project_name] = round($percentage);
            }
            // END CALCULATE PROJECT PERCENTAGE


            $openCount = Ticket::where('fk_ticketOpenerId', Auth::user()->userId)
                               ->where('ticketStatus', 'Open')
                               ->count();

            $overDueCount = Ticket::where('fk_ticketOpenerId', Auth::user()->userId)
                                  ->where('ticketStatus', '!=', 'Close')
                                  ->whereDate('ticket.exp_end_date', '<=', $date)
                                  ->count();

            $pendingCount = Ticket::where('fk_ticketOpenerId', Auth::user()->userId)
                                  ->where('ticketStatus', 'Pending')
                                  ->count();

            $closeCount = Ticket::where('fk_ticketOpenerId', Auth::user()->userId)
                                ->where('ticketStatus', 'Close')
                                ->count();

            // Only for this month
            $currntYear =  date("Y");
            $currntMonth = date("m");

            $allTicketMonth= Ticket::where(DB::raw('MONTH(created_at)'), $currntMonth)
                                   ->where(DB::raw('YEAR(created_at)'), $currntYear)
                                   ->where('fk_ticketOpenerId', Auth::user()->userId)
                                   ->count();

            $openCountMonth= Ticket::where('ticketStatus', 'Open')
                                   ->where(DB::raw('MONTH(created_at)'), $currntMonth)
                                   ->where(DB::raw('YEAR(created_at)'), $currntYear)
                                   ->where('fk_ticketOpenerId', Auth::user()->userId)
                                   ->count();

            $overDueCountMonth = Ticket::whereDate('ticket.exp_end_date', '<=', $date)
                                   ->where(DB::raw('MONTH(created_at)'), $currntMonth)
                                   ->where(DB::raw('YEAR(created_at)'), $currntYear)
                                   ->where('ticketStatus', '!=', 'Close')
                                   ->where('fk_ticketOpenerId', Auth::user()->userId)
                                   ->count();

            $pendingCountMonth = Ticket::where('ticketStatus', 'Pending')
                ->where(DB::raw('MONTH(created_at)'), $currntMonth)
                ->where(DB::raw('YEAR(created_at)'), $currntYear)
                ->where('fk_ticketOpenerId', Auth::user()->userId)
                ->count();

            $closeCountMonth = Ticket::where('ticketStatus', 'Close')
                ->where(DB::raw('MONTH(created_at)'), $currntMonth)
                ->where(DB::raw('YEAR(created_at)'), $currntYear)
                ->where('fk_ticketOpenerId', Auth::user()->userId)
                ->count();


        return view('clientDashboard')->with('openticket', $openCount)
            ->with('overdue', $overDueCount)
            ->with('pending', $pendingCount)
            ->with('close', $closeCount)
            ->with('projectCount', $projectCount)
            ->with('openticketMonth', $openCountMonth)
            ->with('overdueMonth', $overDueCountMonth)
            ->with('pendingMonth', $pendingCountMonth)
            ->with('allticketMonth', $allTicketMonth)
            ->with('closeMonth', $closeCountMonth)
            ->with('project_percentage', $percentage_all);

    }


    public function index()
    {
        //For Employee
        if(Auth::user()->fk_userTypeId == 3){
            return $this->employeeDashboard();
        }
        if(Auth::user()->fk_userTypeId == 2){
            return $this->clientDashboard();
        }



        $userCompanyId = $this->getCompanyUserId();

        if($userCompanyId == null)
        {
            $date = date('Y-m-d h:i:s');

            $totalPartnerProject=null;

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

        }else{

            $totalPartnerProject=ProjectPartner::where('fkPartnerCompanyId',$userCompanyId)->groupBy('fkPartnerCompanyId')->count();

            $employee=Employee::leftJoin('user', 'user.userId', '=', 'companyemployee.employeeUserId')
                                ->select(array('user.*','companyemployee.*','backlog_assignment.*', DB::raw('COUNT(backlog_assignment.fk_backlog_id) as backlog_count')))
                                ->leftJoin('backlog_assignment', 'backlog_assignment.fk_assigned_employee_user_id', '=', 'companyemployee.employeeUserId')
                                ->leftJoin('backlog', 'backlog.backlog_id', '=', 'backlog_assignment.fk_backlog_id')
                                ->whereRaw('(now() between backlog.backlog_start_date and backlog.backlog_end_date)')
                                ->where('companyemployee.fk_companyId',$userCompanyId)
                                ->groupBy('companyemployee.employeeUserId')
                                ->orderBy('backlog_count', 'desc')
                                ->get();

            $employeeTicket=Employee::leftJoin('user', 'user.userId', '=', 'companyemployee.employeeUserId')
                ->select(array('user.*','companyemployee.*','ticket.*', DB::raw('COUNT(ticket.ticket_number) as ticket_count')))
                ->leftJoin('ticket', 'ticket.ticketAssignPersonUserId', '=', 'companyemployee.employeeUserId')
                ->where(DB::raw('MONTH(ticket.created_at)'), date("m"))
                ->where('companyemployee.fk_companyId',$userCompanyId)
                ->groupBy('companyemployee.employeeUserId')
                ->orderBy('ticket_count', 'desc')
                ->get();

            $backlogsOverdue = Backlog::leftJoin('project', 'project.projectId', '=', 'backlog.fk_project_id')
                        ->where('project.fk_company_id', $userCompanyId)
                        ->whereDate('backlog_end_date', '<=', date('Y-m-d'))
                        ->where('backlog_state', '!=', 'Complete')
                        ->where('backlog_state', '!=', 'Testing')
                        ->get();

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

//        $userCompanyId = $this->getCompanyUserId();
        $userCompanyId = Auth::user()->fkCompanyId;

//        return Auth::user();
        // only for super admin
        if($userCompanyId == null)
        {
            $projectCount = Project::all()->count();
            $projectCompleteCount = Project::where('project_status', '5')->count();

            // CALCULATE PROJECT PERCENTAGE
            $projects = Project::all();
            $percentage_all = array();
            $monthlyBacklogCount = 0;
            $monthlyBacklogCompleteCount = 0;

            foreach ($projects as $project){
                $completedBacklog = Backlog::where('fk_project_id', $project->projectId)->where('backlog_state', 'complete')->count();
                if(!empty(Backlog::where('fk_project_id', $project->projectId)->whereRaw('(now() between backlog.backlog_start_date and backlog.backlog_end_date)')->get())){
                    $monthlyBacklogCount++;
                }
                if (!empty(Backlog::where('fk_project_id', $project->projectId)->whereRaw('(now() between backlog.backlog_start_date and backlog.backlog_end_date)')->where('backlog_state', 'Complete')->get())){
                    $monthlyBacklogCompleteCount++;
                }
                $totalBacklog = Backlog::where('fk_project_id', $project->projectId)->count();
                if($totalBacklog == 0)
                {
                    $percentage = 0;
                }
                else
                {
                    $percentage = ($completedBacklog*100)/$totalBacklog;
                }
                $percentage_all[$project->project_name] = round($percentage);
            }
        }
        else
        {
            $projectCount = Project::where('fk_company_id', $userCompanyId)->count();
            $projectCompleteCount = Project::where('fk_company_id', $userCompanyId)->where('project_status', '5')->count();

            // CALCULATE PROJECT PERCENTAGE
            $projects = Project::where('fk_company_id', $userCompanyId)->get();
            $percentage_all = array();
            $monthlyBacklogCount = 0;
            $monthlyBacklogCompleteCount = 0;
//            $completeProject = 0;

            foreach ($projects as $project){
                $completedBacklog = Backlog::where('fk_project_id', $project->projectId)->where('backlog_state', 'complete')->count();
//                $completeProject = $completeProject+$completedBacklog;
                $totalBacklog = Backlog::where('fk_project_id', $project->projectId)->count();
                if(!empty(Backlog::where('fk_project_id', $project->projectId)->where(DB::raw('MONTH(backlog_end_date)'), date("m"))->get())){
                    $monthlyBacklogCount++;
                }
                if (!empty(Backlog::where('fk_project_id', $project->projectId)->where(DB::raw('MONTH(backlog_end_date)'), date("m"))->where('backlog_state', 'Complete')->get())){
                    $monthlyBacklogCompleteCount++;
                }
                if($totalBacklog == 0)
                {
                    $percentage = 0;
                }
                else
                {
                    $percentage = ($completedBacklog*100)/$totalBacklog;
                }
                $percentage_all[$project->project_name] = round($percentage);
            }
            // END CALCULATE PROJECT PERCENTAGE
        }


        $mybacklogs = Backlog::leftJoin('backlog_assignment', 'backlog_assignment.fk_backlog_id', 'backlog.backlog_id')
            ->leftJoin('user', 'user.userId', 'backlog_assignment.fk_assigned_employee_user_id')
            ->leftJoin('project', 'project.projectId', 'backlog.fk_project_id')
            ->where('user.userId', Auth::user()->userId)
            ->where('project.fk_company_id', Auth::user()->fkCompanyId)
            ->whereDate('backlog_start_date', '<=', date('Y-m-d'))
            ->whereDate('backlog_end_date', '>=', date('Y-m-d'))
            ->where('backlog_state', '!=', 'Complete')
            ->where('backlog_state', '!=', 'Testing')
            ->get();

        $mybacklogsMissed = Backlog::leftJoin('backlog_assignment', 'backlog_assignment.fk_backlog_id', 'backlog.backlog_id')
            ->leftJoin('user', 'user.userId', 'backlog_assignment.fk_assigned_employee_user_id')
            ->leftJoin('project', 'project.projectId', 'backlog.fk_project_id')
            ->where('user.userId', Auth::user()->userId)
            ->where('project.fk_company_id', Auth::user()->fkCompanyId)
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
                                 ->with('projectCompleteCount', $projectCompleteCount)
                                 ->with('companyCount', $companyCount)
                                 ->with('openticketMonth', $openCountMonth)
                                 ->with('overdueMonth', $overDueCountMonth)
                                 ->with('pendingMonth', $pendingCountMonth)
                                 ->with('allticketMonth', $allTicketMonth)
                                 ->with('closeMonth', $closeCountMonth)
                                 ->with('mybacklogs', $mybacklogs)
                                 ->with('mybacklogsMissed', $mybacklogsMissed)
                                 ->with('monthlyBacklogCount', $monthlyBacklogCount)
                                 ->with('monthlyBacklogCompleteCount', $monthlyBacklogCompleteCount)
                                 ->with('employes', $employee)
                                 ->with('employeeTicket', $employeeTicket)
                                ->with('totalPartnerProject', $totalPartnerProject)
                                ->with('backlogsOverdue', $backlogsOverdue)

                                 ->with('project_percentage', $percentage_all);
    }

    public function employeeDashboard(){
        $userCompanyId = $this->getCompanyUserId();


        $myCompanies=Employee::select('fk_companyId')
                             ->where('employeeUserId',Auth::user()->userId)->get();

        $date = date('Y-m-d h:i:s');

        $allTicket= Ticket::where('ticketOpenerCompanyId', $userCompanyId)->count();

        $openCount = Ticket::select('ticketId','ticketOpenerCompanyId')
            ->whereIn('ticketOpenerCompanyId', $myCompanies)
            ->where('ticketStatus', 'Open')
            ->get();


        $overDueCount = Ticket::select('ticketId','ticketOpenerCompanyId')
            ->whereIn('ticketOpenerCompanyId', $myCompanies)
            ->where('ticketStatus', '!=', 'Close')
            ->whereDate('ticket.exp_end_date', '<=', $date)
            ->get();

        $pendingCount = Ticket::where('ticketOpenerCompanyId', $userCompanyId)
            ->where('ticketStatus', 'Pending')
            ->count();

        $closeCount = Ticket::select('ticketId','ticketOpenerCompanyId')
            ->whereIn('ticketOpenerCompanyId', $myCompanies)
            ->where('ticketStatus', 'Close')
            ->get();

        // Only for this month
        $currntYear =  date("Y");
        $currntMonth = date("m");

        $allTicketMonth= Ticket::where(DB::raw('MONTH(created_at)'), $currntMonth)
            ->where(DB::raw('YEAR(created_at)'), $currntYear)
            ->where('ticketOpenerCompanyId', $userCompanyId)
            ->count();

        $openCountMonth= Ticket:: select('ticketId','ticketOpenerCompanyId')
            ->where('ticketStatus', 'Open')
            ->where(DB::raw('MONTH(created_at)'), $currntMonth)
            ->where(DB::raw('YEAR(created_at)'), $currntYear)
            ->whereIn('ticketOpenerCompanyId', $myCompanies)
            ->get();

        $overDueCountMonth = Ticket:: select('ticketId','ticketOpenerCompanyId')
            ->whereDate('ticket.exp_end_date', '<=', $date)
            ->where(DB::raw('MONTH(created_at)'), $currntMonth)
            ->where(DB::raw('YEAR(created_at)'), $currntYear)
            ->where('ticketStatus', '!=', 'Close')
            ->whereIn('ticketOpenerCompanyId', $myCompanies)
            ->get();

        $pendingCountMonth = Ticket:: select('ticketId','ticketOpenerCompanyId')->where('ticketStatus', 'Pending')
            ->where(DB::raw('MONTH(created_at)'), $currntMonth)
            ->where(DB::raw('YEAR(created_at)'), $currntYear)
            ->whereIn('ticketOpenerCompanyId', $myCompanies)
            ->get();

        $closeCountMonth = Ticket:: select('ticketId','ticketOpenerCompanyId')->where('ticketStatus', 'Close')
            ->where(DB::raw('MONTH(created_at)'), $currntMonth)
            ->where(DB::raw('YEAR(created_at)'), $currntYear)
            ->where('ticketOpenerCompanyId', $userCompanyId)
            ->get();



        // Company
        $companyCount = Company::all()->count();

        // Project

        $userCompanyId = $this->getCompanyUserId();


            $projectCount = Project::select('projectId','fk_company_id')
                ->whereIn('fk_company_id', $myCompanies)
                ->get();

//            return $projectCount;



            // CALCULATE PROJECT PERCENTAGE
            $projects = Project::whereIn('fk_company_id', $myCompanies)->get();

//            return $projects;
            $percentage_all = array();

            foreach ($projects as $project){
                $completedBacklog = Backlog::where('fk_project_id', $project->projectId)->where('backlog_state', 'complete')->count();
                $totalBacklog = Backlog::where('fk_project_id', $project->projectId)->count();
                if($totalBacklog == 0)
                {
                    $percentage = 0;
                }
                else
                {
                    $percentage = ($completedBacklog*100)/$totalBacklog;
                }
                $percentage_all[$project->project_name] = round($percentage);
            }
//            return $percentage_all;
            // END CALCULATE PROJECT PERCENTAGE



        $mybacklogs = Backlog::leftJoin('backlog_assignment', 'backlog_assignment.fk_backlog_id', 'backlog.backlog_id')
            ->leftJoin('user', 'user.userId', 'backlog_assignment.fk_assigned_employee_user_id')
            ->leftJoin('project', 'project.projectId', 'backlog.fk_project_id')
            ->where('user.userId', Auth::user()->userId)
            ->whereIn('project.fk_company_id', $myCompanies)
            ->whereDate('backlog_start_date', '<=', date('Y-m-d'))
            ->whereDate('backlog_end_date', '>=', date('Y-m-d'))
            ->where('backlog_state', '!=', 'Complete')
            ->where('backlog_state', '!=', 'Testing')
            ->get();

        $mybacklogsMissed = Backlog::leftJoin('backlog_assignment', 'backlog_assignment.fk_backlog_id', 'backlog.backlog_id')
            ->leftJoin('user', 'user.userId', 'backlog_assignment.fk_assigned_employee_user_id')
            ->leftJoin('project', 'project.projectId', 'backlog.fk_project_id')
            ->where('user.userId', Auth::user()->userId)
            ->whereIn('project.fk_company_id', $myCompanies)
            ->whereDate('backlog_end_date', '<=', date('Y-m-d'))
            ->where('backlog_state', '!=', 'Complete')
            ->where('backlog_state', '!=', 'Testing')
            ->get();






        return view('employeeDashboard')->with('openticket', $openCount)
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

    // SHOW ALL NOTIFICATION
    public function showAllNotification()
    {
        $allNotification = Notification::leftJoin('backlog', 'backlog.backlog_id', 'notification.task_id')
                                       ->where('assigned_emp_id', Auth::user()->userId)
                                        ->orderBy('assigned_time', 'desc')
                                       ->get();

        return view('Notification.allNotification')->with('allNotification', $allNotification);
    }

    // AJAX REQUEST TO GET UNSEEN NOTIFICATION
    public function getAllNotificationData(){
        $myNotification = Notification::leftJoin('backlog', 'backlog.backlog_id', 'notification.task_id')
            ->where('assigned_emp_id', Auth::user()->userId)
            ->where('seen', '0')
            ->orderBy('assigned_time', 'desc')
            ->get();

        return view('Notification.unseenNotification')->with('myNotificationOld', $myNotification);
    }

    public function changeunseen(){

        $notificationOld = Notification::leftJoin('backlog', 'backlog.backlog_id', 'notification.task_id')
            ->where('assigned_emp_id', Auth::user()->userId)
            ->where('seen', '0')
            ->get();

        Notification::leftJoin('backlog', 'backlog.backlog_id', 'notification.task_id')
            ->where('assigned_emp_id', Auth::user()->userId)
            ->where('seen', '0')
            ->update(['seen' => 1]);

        return view('Notification.unseenNotification')->with('myNotificationOld', $notificationOld);
    }


}
