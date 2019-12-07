<?php

namespace App\Http\Controllers;

use App\Backlog;
use App\ClientContactPersonUserRelation;
use App\Exports\BacklogExport;
use App\Notification;
use Illuminate\Http\Request;
use App\Project;
use App\Company;
use \Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use Yajra\DataTables\DataTables;
use App\Status;
use App\Client;
use App\Employee;
use App\User;
use Carbon\Carbon;
use App\BacklogAssignment;
use App\BacklogComment;
use App\BacklogTimeChart;


class ProjectManagementController extends Controller
{

    public $user_company_id;

    // Get user's company user id
    public function getCompanyUserId(){

        if(Auth::user()->fk_userTypeId == 2)
        {
            $this->user_company_id = ClientContactPersonUserRelation::where('person_userId', Auth::user()->userId)->first()->clientId;
        }
        if(Auth::user()->fk_userTypeId == 3 || Auth::user()->fk_userTypeId == 4 || Auth::user()->fk_userTypeId == 5)
        {
            $this->user_company_id = Auth::user()->fkCompanyId;
        }
//        if(Auth::user()->fk_userTypeId == 4)
//        {
////            $this->user_company_id = Auth::user()->fkCompanyId;
//            $this->user_company_id = Employee::where('employeeUserId', Auth::user()->userId)->first()->fk_companyId;
//        }
        if(Auth::user()->fk_userTypeId == 1)
        {
            $this->user_company_id = null;
        }

        return $this->user_company_id;
    }

    // Project
    public function projectInformation($id){
        $project = Project::where('projectId', $id)->first();
        return view('Project.ProjectManagement.dashboard')->with('project_id', $id)
                                                               ->with('project', $project);
    }

    public function getAllData(Request $r){

        $backlog = Backlog::where('fk_project_id', $r->project_id)->get();

        if($r->edit == false)
        {
            $edit = false;
        }
        else
        {
            $edit = true;
        }

        return view('Project.ProjectManagement.get_backlog_table')->with('backlogs', $backlog)->with('edit', $edit);
    }

    // GET ALL BACKLOG FOR DATATABLE
    public function getAllMyBacklog(Request $r){

        $backlog = Backlog::where('fk_project_id', $r->project_id)
            ->leftJoin('backlog_comment', 'backlog.backlog_id', 'backlog_comment.fk_backlog_id')->orderBy('backlog_id', 'desc');
        return $datatables = Datatables::of($backlog)->make(true);
    }

    // Project Management Dashboard
    public function projectmanagementDashboard(){

        $allStatus = Status::where('statusType', 'project_status')->get();

        // Get user's company ID
        $userCompanyId = $this->getCompanyUserId();

        // get all project of user's company
        if($userCompanyId == null)
        {
            $projects = Project::select('project.project_name','status.statusData','user.fullName','company.companyName','project.projectId', 'project.project_status')
                                ->Join('company','project.fk_company_id','company.companyId')
                                ->Join('user','project.project_created_by','user.userId')
                                ->Join('status','project.project_status','status.statusId')
                                ->where('project.project_deleted_at', null)
                                ->where('project.project_status', '!=', 6)
                                ->get();
        }
        else
        {
            $projects = Project::select('project.project_name','status.statusData','user.fullName','company.companyName','project.projectId', 'project.project_status')
                               ->Join('company','project.fk_company_id','company.companyId')
                               ->Join('user','project.project_created_by','user.userId')
                               ->Join('status','project.project_status','status.statusId');

            if(Auth::user()->fk_userTypeId == 2)
            {
                $projects = $projects->where('fk_client_id',$userCompanyId);
            }
            else
            {
                $projects=$projects->where('fk_company_id',$userCompanyId);
            }

            $projects=$projects->where('project.project_deleted_at', null)
                               ->where('project.project_status', '!=', 6)->get();
        }

        return view('Project.ProjectManagement.projectList')->with('projects', $projects)
                                                                 ->with('allStatus', $allStatus);
    }
    // Project Backlog Dashboard
    public function projectmanagement($id){

        $userCompanyId = $this->getCompanyUserId();

        // get employee list
        if($userCompanyId == null)
        {
            $allEmp = User::where('fk_userTypeId', 3)->get();
        }
        else
        {
            $allEmp = User::leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')
                ->where('companyemployee.fk_companyId',$userCompanyId)
                ->whereIn('user.fk_userTypeId', [3,5])
                ->get();
        }

        $project = Project::findOrFail($id);

        $inCompletebacklog = Backlog::leftJoin('backlog_assignment', 'backlog_assignment.fk_backlog_id', 'backlog.backlog_id')
                                     ->where('fk_project_id', $id)
                                     ->where('backlog_completion_status', 'Incomplete')
                                     ->groupBy('backlog.backlog_id')
                                     ->orderBy('backlog.backlog_id','desc' )
                                     ->get();

        // select backlog assigned employee list
        $backlog = BacklogAssignment::leftJoin('backlog', 'backlog.backlog_id', 'backlog_assignment.fk_backlog_id')
                                    ->where('backlog.fk_project_id', $id)->get();

        $array = array();
        foreach ($backlog as $emp)
        {
            array_push($array, $emp->fk_assigned_employee_user_id);
        }


        $backlogassignedEmp = User::leftJoin('backlog_assignment', 'backlog_assignment.fk_assigned_employee_user_id', 'user.userId')
                                    ->whereIn('user.userId', $array)
                                    ->get();


        $completebacklog = Backlog::where('fk_project_id', $id)
            ->where('backlog_completion_status', 'Completed')
            ->orderBy('backlog.backlog_id','desc' )
            ->get();

        $backlog_count = Backlog::where('fk_project_id', $id)->get()->count();
        $total_hour = Backlog::where('fk_project_id', $id)->get()->sum('backlog_time');

        return view('Project.ProjectManagement.projectBacklogDashboard')->with('project', $project)
                                                                             ->with('inCompletebacklogs', $inCompletebacklog)
                                                                             ->with('completebacklogs', $completebacklog)
                                                                             ->with('backlogassignedEmp', $backlogassignedEmp)
                                                                             ->with('backlog_count', $backlog_count)
                                                                             ->with('total_hour', $total_hour)
                                                                             ->with('allEmp', $allEmp);
    }

    // Insert Backlog
    public function insertBacklog(Request $r){
        $backlog = new Backlog();
        $backlog->backlog_title = $r->backlog_title;
        $backlog->fk_project_id = $r->project_id;
        $backlog->backlog_time = $r->backlog_time;
        $backlog->remark = $r->remark;
        if($r->backlog_state)
        {
            $backlog->backlog_state = $r->backlog_state;
        }else{
            $backlog->backlog_state = 'Planned';
        }
        if($r->startdate == null)
        {
            $backlog->backlog_start_date = null;
        }else{
            $backlog->backlog_start_date = Carbon::parse($r->startdate)->format('Y-m-d h:i:s');
        }

        // end date
        if($r->enddate == null)
        {
            $backlog->backlog_end_date = null;
        }elseW{
            $backlog->backlog_end_date = Carbon::parse($r->enddate)->format('Y-m-d h:i:s');
        }
        $backlog->backlog_details = $r->backlogDetails;
        $backlog->backlog_priority = $r->priority;
        $backlog->backlog_completion_status = 'Incomplete';
        $backlog->backlog_created_at = date('Y-m-d H:i:s');
        $backlog->save();

        if($r->assigned_employee)
        {
            foreach ($r->assigned_employee as $emp){
                $assignment = new BacklogAssignment();
                $assignment->fk_backlog_id = $backlog->backlog_id;
                $assignment->fk_assigned_employee_user_id = $emp;
                $assignment->backlog_assignment_created_at = date('Y-m-d H:i:s');
                $assignment->save();

                // FOR NOTIFICATION
                $notification = new Notification();
                $notification->assigned_emp_id = $emp;
                $notification->assigned_type = 'Backlog';
                $notification->task_id = $backlog->backlog_id;
                $notification->assigned_time = date('Y-m-d H:i:s');
                $notification->seen = 0;
                $notification->save();
            }
        }

        Session::flash('message', 'New Backlog Created!');

        return back();
    }

    // Project Management
    public function returnEditBacklog(Request $r){


        // Get user's company ID
        $userCompanyId = $this->getCompanyUserId();

        // get employee list
        if($userCompanyId == null)
        {
            $allEmp = User::where('fk_userTypeId', 3)->get();
        }
        else
        {
            $allEmp = User::leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')
                ->where('companyemployee.fk_companyId',$userCompanyId)
                ->whereIn('user.fk_userTypeId', [3,5])
                ->get();
        }


        $backlog = Backlog::findOrFail($r->backlog_id);


        $backlogAssignedEmp = BacklogAssignment::where('fk_backlog_id', $r->backlog_id)->get();

        return view('Project.ProjectManagement.updateBacklog')->with('backlog', $backlog)
                                                                   ->with('backlogAssignedEmp', $backlogAssignedEmp)
                                                                   ->with('allEmp', $allEmp);
    }

    public function updateBacklog(Request $r){
        $backlog = Backlog::findOrFail($r->backlog_id);
        $backlog->backlog_title = $r->backlog_title;
        $backlog->backlog_time = $r->backlog_time;
        $backlog->backlog_start_date = Carbon::parse($r->startdate)->format('Y-m-d h:i:s');
        $backlog->backlog_end_date = Carbon::parse($r->enddate)->format('Y-m-d h:i:s');
        $backlog->backlog_details = $r->backlogDetails;
        $backlog->backlog_priority = $r->priority;
        $backlog->remark = $r->remark;

        $backlog->save();

        BacklogAssignment::where('fk_backlog_id', $r->backlog_id)->delete();
        Notification::where('assigned_type', 'Backlog')
                    ->where('task_id', $r->backlog_id)
                    ->delete();

        if($r->assigned_employee)
        {
            foreach ($r->assigned_employee as $emp){
                $assignment = new BacklogAssignment();
                $assignment->fk_backlog_id = $backlog->backlog_id;
                $assignment->fk_assigned_employee_user_id = $emp;
                $assignment->backlog_assignment_created_at = date('Y-m-d H:i:s');
                $assignment->save();

                // FOR NOTIFICATION
                $notification = new Notification();
                $notification->assigned_emp_id = $emp;
                $notification->assigned_type = 'Backlog';
                $notification->task_id = $backlog->backlog_id;
                $notification->assigned_time = date('Y-m-d H:i:s');
                $notification->seen = 0;
                $notification->save();
            }
        }

        Session::flash('message', 'Backlog Updated!');

        return back();
    }

    // Post Comment
    public function postComment(Request $r){
        $comment = new BacklogComment();
        $comment->fk_comment_user_id = $r->user_id;
        $comment->fk_backlog_id = $r->backlog_id;
        $comment->comment = $r->comment;
        $comment->comment_created_at = date('Y-m-d H:i:s');
        $comment->save();
        return back();
    }

    // get Comments
    public function getComments(Request $r){
        $backlogComments = BacklogComment::leftJoin('user', 'user.userId', 'backlog_comment.fk_comment_user_id')->where('fk_backlog_id', $r->backlog_id)->get();
        return view('Project.ProjectManagement.getAllComments')->with('comments', $backlogComments);
    }


    // Generate Report
    public function generateReport(Request $r){
        Excel::store(new BacklogExport($r), 'project_backlog.xlsx');
    }

    // SHOW GANTT CHART
    public function showGanttChart($id){
        $backlog = Backlog::where('fk_project_id', $id)->get();
        $projectName = Project::findOrfail($id)->project_name;
        return view('Project.ProjectManagement.ganttChart')->with('backlogs', $backlog)
                                                                ->with('projectName', $projectName);
    }

    // SHOW FEATURES
    public function projectFeature($id){


        $project = Project::where('projectId', $id)->first();

        $exp_time = Backlog::where('fk_project_id', $id)->get()->sum('backlog_time');

        $comments = BacklogComment::leftJoin('backlog', 'backlog.backlog_id', 'backlog_comment.fk_backlog_id')

                                ->where('fk_project_id', $id)
                                ->get();

        return view('Project.ProjectManagement.projectFeatures')->with('project', $project)
                                                                     ->with('exp_time', $exp_time)
                                                                     ->with('backlogComments', $comments);
    }

    // SHOW EDIT MODAL
    public function getEditModal(Request $r){
        $backlog = Backlog::findOrFail($r->backlog_id);
        return view('Project.ProjectManagement.editBacklog')->with('backlog', $backlog);
    }

    // UPDATE BACKLOG DATA
    public function updateBacklogdata(Request $r){
        $backlog = Backlog::findOrFail($r->backlog_id);
        $backlog->backlog_title = $r->title;
        $backlog->backlog_time = $r->exp_time;
        $backlog->backlog_state = $r->backlog_state;
        $backlog->backlog_start_date = $r->startdate;
        $backlog->backlog_end_date = $r->enddate;
        $backlog->backlog_priority = $r->priority;
        $backlog->remark = $r->remark;
        $backlog->save();

        if($r->backlog_state == 'Ongoing'){
            $backlogTimeChart = new BacklogTimeChart();
            $backlogTimeChart->backlog_id = $r->backlog_id;
            $backlogTimeChart->hour = $r->hour;
            $backlogTimeChart->user_id = Auth::user()->userId;
            $backlogTimeChart->date = date('Y-m-d');
            $backlogTimeChart->save();
        }

        Session::flash('message', 'Feature Updated!');

        return back();
    }

    // UPDATE BACKLOG DATA
    public function deleteBacklog(Request $r){
        $backlog = Backlog::findOrFail($r->backlog_id);
        $backlog->delete();
        return back();
    }

    public function getAllMyComments(Request $r){
        $comments = BacklogComment::leftJoin('user', 'user.userId', 'backlog_comment.fk_comment_user_id')->where('fk_backlog_id', $r->backlog_id)->get();
        return view('Project.ProjectManagement.showAllComments')->with('comments', $comments);
    }

    public function getAllOwners(Request $r){
        $owners = BacklogAssignment::leftJoin('user', 'user.userId', 'backlog_assignment.fk_assigned_employee_user_id')->where('fk_backlog_id', $r->backlog_id)->get();
        return view('Project.ProjectManagement.showOwnerModal')->with('owners', $owners);
    }

    public function backlogContinue(Request $r){
        $backlogTimeChart = new BacklogTimeChart();
        $backlogTimeChart->backlog_id = $r->backlog_id;
        $backlogTimeChart->hour = $r->hour;
        $backlogTimeChart->user_id = Auth::user()->userId;
        $backlogTimeChart->date = date('Y-m-d');
        $backlogTimeChart->save();
        return;
    }
}
