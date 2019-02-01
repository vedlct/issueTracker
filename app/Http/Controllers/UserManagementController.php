<?php

namespace App\Http\Controllers;

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

class UserManagementController extends Controller
{
    // Employee list
    public function employeelist(){

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
                ->get();
        }
        else
        {
            $employeelist = DB::table('user')
                                ->leftJoin('usertype','usertype.userTypeId','user.fk_userTypeId')
                                ->leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')
                                ->where('user.fk_userTypeId', 3)
                                ->where('companyemployee.fk_companyId', $userCompanyId)
                                ->get();
        }

        return view('Usermanagement.employeeList')->with('employeelist', $employeelist);
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
            $companylist = Company::all();
        }
        else
        {
            $companylist = Company::where('companyId', $userCompanyId)->get();
        }

        return view('Usermanagement.addEmployee')->with('companyList', $companylist);
    }

    // Add Client
    public function addClient(){

        // Get user's company ID
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
        $user->userPhoneNumber = $r->phone;
        $user->created_at = $date;
        $user->updated_at = $date;
        $user->fk_userTypeId = 3;
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
        return back();
    }

    public function editEmployee($id){

        // Get user's company ID
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
            $companylist = Company::all();
        }
        else
        {
            $companylist = Company::where('companyId', $userCompanyId)->get();
        }


        $employee = User::where('userId',$id)->leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')
                                            ->leftJoin('company', 'company.companyId', 'companyemployee.fk_companyId')
                                            ->first();

        return view('Usermanagement.editEmployee')->with('employee', $employee)
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

        Session::flash('message', 'Company Admin Created');
        return back();
    }

    // show all admin
    public function adminList(){
        $adminlist = DB::table('user')->leftJoin('usertype','usertype.userTypeId','user.fk_userTypeId')->where('user.fk_userTypeId', 4)->get();
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

    // update admin info
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
        Employee::where('employeeUserId', $r->userId)->update(['fk_companyId'=> $r->companyId]);

        Session::flash('message', 'Admin Info Updated!');

        return back();
    }


}
