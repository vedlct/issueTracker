<?php

namespace App\Http\Controllers;

use App\Department;
use App\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use App\User;
use App\Employee;
use Hash;
use Session;
use DB;
use App\Client;
use Auth;
use Yajra\DataTables\DataTables;

class UserManagementController extends Controller
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
            $this->user_company_id =Auth::user()->fkCompanyId;
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

    // Employee list
    public function employeelist(){Auth::user()->fkCompanyId;

        // Get user's company ID
        if(Auth::user()->fk_userTypeId == 4)
        {
            $userCompanyId = Employee::where('employeeUserId', Auth::user()->userId)->first()->fk_companyId;
        }
        if(Auth::user()->fk_userTypeId == 1)
        {
            $userCompanyId = null;
        }

        // get all user of current user's company
        if($userCompanyId == null)
        {
            $employeelist = DB::table('user')
                ->leftJoin('usertype','usertype.userTypeId','user.fk_userTypeId')
                ->where('user.fk_userTypeId', 3)
                ->leftJoin('designation','designation.designation_id','user.designation')
                ->get();
        }
        else
        {
            $employeelist = DB::table('user')
                                ->leftJoin('usertype','usertype.userTypeId','user.fk_userTypeId')
                                ->leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')
                                ->leftJoin('designation','designation.designation_id','user.designation')
                                ->where('user.fk_userTypeId', 3)
                                ->where('companyemployee.fk_companyId', $userCompanyId)
                                ->get();
        }

        return view('Usermanagement.employeeList')->with('employeelist', $employeelist);
    }

    public function today_work()
    {
        if(Auth::user()->fk_userTypeId == 4)
        {
            $userCompanyId = Employee::where('employeeUserId', Auth::user()->userId)->first()->fk_companyId;
        }
        if(Auth::user()->fk_userTypeId == 1)
        {
            $userCompanyId = null;
        }

        // get all user of current user's company
        if($userCompanyId == null)
        {
            $employeelist = DB::table('user')
                ->leftJoin('usertype','usertype.userTypeId','user.fk_userTypeId')
                ->leftJoin('backlog_assignment','backlog_assignment.fk_assigned_employee_user_id','user.userId')
                ->leftJoin('backlog','backlog.backlog_id','backlog_assignment.fk_backlog_id')
                ->leftJoin('project','project.projectId','backlog.fk_project_id')
                ->where('user.fk_userTypeId', 3)
                ->whereRaw('? between backlog.backlog_start_date and backlog.backlog_end_date', [date('Y-m-d')])
                ->leftJoin('designation','designation.designation_id','user.designation')
                ->get();
        }
        else
        {
            $employeelist = DB::table('user')
                ->leftJoin('usertype','usertype.userTypeId','user.fk_userTypeId')
                ->leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')
                ->leftJoin('designation','designation.designation_id','user.designation')
                ->leftJoin('backlog_assignment','backlog_assignment.fk_assigned_employee_user_id','user.userId')
                ->leftJoin('backlog','backlog.backlog_id','backlog_assignment.fk_backlog_id')
                ->leftJoin('project','project.projectId','backlog.fk_project_id')
                ->where('user.fk_userTypeId', 3)
                ->whereRaw('? between backlog.backlog_start_date and backlog.backlog_end_date', [date('Y-m-d')])
                ->where('companyemployee.fk_companyId', $userCompanyId)
                ->get();
        }
        return view('Usermanagement.todayWork')->with('employeelist', $employeelist);
    }

    // client list
    public function clientlist(){

        // Get user's company ID
        if(Auth::user()->fk_userTypeId == 4)
        {
            $userCompanyId = Employee::where('employeeUserId', Auth::user()->userId)->first()->fk_companyId;
        }
        if(Auth::user()->fk_userTypeId == 1)
        {
            $userCompanyId = null;
        }


        // get all user of current user's company
        if($userCompanyId == null)
        {
            $clientlist = DB::table('user')->leftJoin('usertype','usertype.userTypeId','user.fk_userTypeId')->where('user.fk_userTypeId', 2)->get();
        }
        else
        {
            $clientlist = DB::table('user')
                ->leftJoin('usertype','usertype.userTypeId','user.fk_userTypeId')
                ->leftJoin('client', 'client.userId', 'user.userId')
                ->where('user.fk_userTypeId', 2)
                ->where('client.companyId', $userCompanyId)
                ->get();
        }

        return view('Usermanagement.clientList')->with('clientlist', $clientlist);
    }

    // Add Employee
    public function addEmployee(){

        // Get user's company ID
        $userCompanyId = $this->getCompanyUserId();

        if($userCompanyId == null)
        {
            $companylist = Company::all();
        }
        else
        {
            $companylist = Company::where('companyId', $userCompanyId)->get();
        }

        $designations = Designation::where('company_id', $userCompanyId)
                                    ->where('deleted_at', null)->get();

        $departments = Department::where('company_id', $userCompanyId)
                                    ->where('dept_deleted_at', null)->get();

        return view('Usermanagement.addEmployee')->with('companyList', $companylist)
                                                      ->with('departments', $departments)
                                                      ->with('designations', $designations);
    }

    // Add Client
    public function addClient(){

        // Get user's company ID
        $userCompanyId = $this->getCompanyUserId();

        if($userCompanyId == null)
        {
            $companylist = Company::all();
        }
        else
        {
            $companylist = Company::where('companyId', $userCompanyId)->get();
        }

        return view('Usermanagement.addClient')->with('companyList', $companylist);
    }

    // Insert Client
    public function insertClient(Request $r){
        $r->validate([
            'password1' => 'required|same:password2'
        ]);

        $date = date('Y-m-d h:i:s');

        // AS A USER
        $user = new User();
        $user->fullName = $r->fullname;
        $user->password = Hash::make($r->password1);
        $user->email = $r->email;
        $user->status = 1;
        $user->userPhoneNumber = $r->phone;
        $user->created_at = $date;
        $user->updated_at = $date;
        $user->fk_userTypeId = 2;
        $user->fkCompanyId = Auth::user()->fkCompanyId;
//        dd(Auth::user()->fkCompanyId);
        $user->save();

        if ($r->hasFile('profilePhoto')) {
            $file = $r->file('profilePhoto');
            $fileName = $user->userId . "." . $file->getClientOriginalExtension();
            $destinationPath = public_path('files/profileImage');
            $file->move($destinationPath, $fileName);
            $user->profilePhoto=$fileName;
            $user->save();
        }

        // AS A Client
        $client = new Client();
        $client->created_at = $date;
        $client->userId = $user->userId;
        $client->companyId = $r->companyId;
        $client->save();

        Session::flash('message', 'Client Created!');

        return back();
    }

    public function insertEmployee(Request $r){

        $r->validate([
            'password1' => 'required|same:password2'
        ]);

        $date = date('Y-m-d h:i:s');

        // AS A USER
        $user = new User();
        $user->fullName = $r->fullname;
        $user->password = Hash::make($r->password1);
        $user->email = $r->email;
        $user->status = 1;
        $user->designation = $r->designation;
        $user->department = $r->dept;
        $user->userPhoneNumber = $r->phone;
        $user->created_at = $date;
        $user->updated_at = $date;
        $user->fk_userTypeId = 3;
        $user->fkCompanyId = $r->companyId;
        $user->save();

        if ($r->hasFile('profilePhoto')) {
            $file = $r->file('profilePhoto');
            $fileName = $user->userId . "." . $file->getClientOriginalExtension();
            $destinationPath = public_path('files/profileImage');
            $file->move($destinationPath, $fileName);
            $user->profilePhoto=$fileName;
            $user->save();
        }

        // AS A EMPLOYEE
        $emp = new Employee();
        $emp->created_at = $date;
        $emp->fk_companyId = $r->companyId;
        $emp->employeeUserId = $user->userId;
        $emp->save();

        Session::flash('message', 'Employee Created!');
        return redirect()->route('user.show.allEmployee');
    }

    public function editEmployee($id){

        // Get user's company ID
        $userCompanyId = $this->getCompanyUserId();

        if($userCompanyId == null)
        {
            $companylist = Company::all();
        }
        else
        {
            $companylist = Company::where('companyId', $userCompanyId)->get();
        }


        $employee = User::where('userId',$id)->leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')
                                            ->leftJoin('company', 'company.companyId', 'companyemployee.fk_companyId')
                                            ->first();

        $designations = Designation::where('company_id', $userCompanyId)
                                    ->where('deleted_at', null)
                                    ->get();

        $departments = Department::where('company_id', $userCompanyId)
                                 ->where('dept_deleted_at', null)
                                 ->get();

        return view('Usermanagement.editEmployee')->with('employee', $employee)
                                                        ->with('designations', $designations)
                                                        ->with('departments', $departments)
                                                        ->with('companyList', $companylist);
    }

    public function updateEmployee(Request $r){
        $date = date('Y-m-d h:i:s');

        if($r->password1)
        {
            $r->validate([
                'password1' => 'required|same:password2'
            ]);
        }

        // AS A USER
        $user = User::findOrFail($r->userId);
        $user->fullName = $r->fullname;
        if($r->password1)
        {
            $user->password = Hash::make($r->password1);
        }
        $user->email = $r->email;
        $user->status = $r->employeeStatus;
        $user->userPhoneNumber = $r->phone;
        $user->updated_at = $date;
        $user->designation = $r->designation;
        $user->department = $r->dept;
        $user->save();

        if ($r->hasFile('profilePhoto')) {
            $file = $r->file('profilePhoto');
            $fileName = $user->userId . "." . $file->getClientOriginalExtension();
            $destinationPath = public_path('files/profileImage');
            $file->move($destinationPath, $fileName);
            $user->profilePhoto=$fileName;
            $user->save();
        }

        // AS A EMPLOYEE
        Employee::where('employeeUserId', $r->userId)->update(['fk_companyId'=> $r->companyId]);

        Session::flash('message', 'Employee Updated!');

        return back();
    }

    public function editClient($id){

        // Get user's company ID
        $userCompanyId = $this->getCompanyUserId();

        if($userCompanyId == null)
        {
            $companylist = Company::all();
        }
        else
        {
            $companylist = Company::where('companyId', $userCompanyId)->get();
        }

        $client = User::where('user.userId', $id)->leftJoin('client', 'client.userId', 'user.userId')
                                            ->leftJoin('company', 'company.companyId', 'client.companyId')
                                            ->first();

        return view('Usermanagement.editClient')
                    ->with('client', $client)
                    ->with('companyList', $companylist);
    }

    public function updateClient(Request $r){
        $date = date('Y-m-d h:i:s');

        if($r->password1)
        {
            $r->validate([
                'password1' => 'required|same:password2'
            ]);
        }

        // AS A USER
        $user = User::findOrFail($r->userId);
        $user->fullName = $r->fullname;
        if($r->password1)
        {
            $user->password = Hash::make($r->password1);
        }
        $user->email = $r->email;
        $user->status = $r->clientStatus;
        $user->userPhoneNumber = $r->phone;
        $user->updated_at = $date;
        $user->save();

        if ($r->hasFile('profilePhoto')) {
            $file = $r->file('profilePhoto');
            $fileName = $user->userId . "." . $file->getClientOriginalExtension();
            $destinationPath = public_path('files/profileImage');
            $file->move($destinationPath, $fileName);
            $user->profilePhoto=$fileName;
            $user->save();
        }

        // AS A Client
        Client::where('userId', $r->userId)->update(['companyId'=> $r->companyId]);

        Session::flash('message', 'Client Updated!');

        return back();
    }

    // add company admin view
    public function addCompanyAdmin(){
        $companylist = Company::all();
        return view('Usermanagement.addCompanyAdmin')->with('companyList', $companylist);
    }

    // add company admin view
    public function insertCompanyAdmin(Request $r){
        $r->validate([
            'password1' => 'required|same:password2'
        ]);

        $date = date('Y-m-d h:i:s');

        // AS A USER
        $user = new User();
        $user->fullName = $r->fullname;
        $user->password = Hash::make($r->password1);
        $user->email = $r->email;
        $user->status = 1;
        $user->userPhoneNumber = $r->phone;
        $user->created_at = $date;
        $user->updated_at = $date;
        $user->fk_userTypeId = 4;
        $user->fkCompanyId = $r->companyId;
        $user->save();

        if ($r->hasFile('profilePhoto')) {
            $file = $r->file('profilePhoto');
            $fileName = $user->userId . "." . $file->getClientOriginalExtension();
            $destinationPath = public_path('files/profileImage');
            $file->move($destinationPath, $fileName);
            $user->profilePhoto=$fileName;
            $user->save();
        }

        // AS A EMPLOYEE
        $emp = new Employee();
        $emp->created_at = $date;
        if($r->myCompany == "myCompany")
        {
            $emp->fk_companyId = $this->getCompanyUserId();
        }
        else
        {
            $emp->fk_companyId = $r->companyId;
        }
        $emp->employeeUserId = $user->userId;
        $emp->save();

        Session::flash('message', 'Company Admin Created');
        return back();
    }

    // show all admin
    public function adminList(){
        $adminlist = DB::table('user')
                       ->leftJoin('usertype','usertype.userTypeId','user.fk_userTypeId')
                       ->leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')
                       ->leftJoin('company', 'company.companyId', 'companyemployee.fk_companyId')
                       ->where('user.fk_userTypeId', 4)
                       ->get();

        return view('Usermanagement.allAdminList')->with('adminlist', $adminlist);
    }

    public function editAdmin($id){
        $companylist = Company::all();
        $employee = User::where('userId',$id)->leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')
                                             ->leftJoin('company', 'company.companyId', 'companyemployee.fk_companyId')
                                             ->first();

        return view('Usermanagement.editAdmin')->with('employee', $employee)
                                                    ->with('companyList', $companylist);
    }

    public function deleteAdmin(Request $r){
        User::findOrFail($r->id)->delete();
        Employee::where('employeeUserId', $r->id)->delete();

        return back();
    }

    // UPDATE ADMIN INFO
    public function updateAdmin(Request $r){
        $date = date('Y-m-d h:i:s');

        if($r->password1)
        {
            $r->validate([
                'password1' => 'required|same:password2'
            ]);
        }

        // AS A USER
        $user = User::findOrFail($r->userId);
        $user->fullName = $r->fullname;
        if($r->password1)
        {
            $user->password = Hash::make($r->password1);
        }
        $user->email = $r->email;
        $user->status = $r->employeeStatus;
        $user->userPhoneNumber = $r->phone;
        $user->updated_at = $date;
        $user->save();

        if ($r->hasFile('profilePhoto')) {
            $file = $r->file('profilePhoto');
            $fileName = $user->userId . "." . $file->getClientOriginalExtension();
            $destinationPath = public_path('files/profileImage');
            $file->move($destinationPath, $fileName);
            $user->profilePhoto=$fileName;
            $user->save();
        }

        // AS A employee
        if(!$r->myCompany)
        {
            Employee::where('employeeUserId', $r->userId)->update(['fk_companyId'=> $r->companyId]);
        }

        Session::flash('message', 'Admin Info Updated!');

        return back();
    }

    public function emp_to_manyCompany(){
        $emp = User::where('fk_userTypeId', '3')->get();
        $companylist = Company::all();

        return view('Usermanagement.addEmpManyCompany')->with('emp', $emp)
                                                            ->with('companyList', $companylist);
    }

    public function getEmpList(){
        $allEmployeeList = Employee::leftJoin('user','user.userId', 'companyemployee.employeeUserId')
                                   ->leftJoin('company', 'company.companyId', 'companyemployee.fk_companyId');

        $datatables = Datatables::of($allEmployeeList);
        return $datatables->make(true);
    }

    public function deleteFromCompany(Request $r){
        Employee::where('companyEmployeeId',$r->id)->delete();
//        return $r;
    }

    public function assignEmployeeCompany(Request $r){
        $count=Employee::where('employeeUserId',$r->empId)->where('fk_companyId',$r->companyId)
            ->count();
        if($count==0){
            $empCompany=new Employee();
            $empCompany->fk_companyId=$r->companyId;
            $empCompany->employeeUserId=$r->empId;
            $empCompany->save();
        }

        return back();
    }


}
