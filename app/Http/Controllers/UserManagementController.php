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

class UserManagementController extends Controller
{
    // Employee list
    public function employeelist(){
        $employeelist = DB::table('user')->leftJoin('usertype','usertype.userTypeId','user.fk_userTypeId')->where('user.fk_userTypeId', 3)
                                                                                                            ->where('user.status',1)
                                                                                                            ->get();
        return view('Usermanagement.employeeList')->with('employeelist', $employeelist);
    }

    public function addEmployee(){
        $companylist = Company::all();
        return view('Usermanagement.addEmployee')->with('companyList', $companylist);
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
        $companylist = Company::all();
        $employee = User::where('userId',$id)->leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')
                                            ->leftJoin('company', 'company.companyId', 'companyemployee.fk_companyId')
                                            ->first();

        return view('Usermanagement.editEmployee')->with('employee', $employee)
                                                        ->with('companyList', $companylist);
    }

    public function deleteEmployee(Request $r){
        $employee = User::findOrFail($r->id);
        $employee->status = 0;
        $employee->save();

//        Session::flash('message', 'Employee Deleted!');
//
//        return redirect()->route('user.show.allEmployee');

        return back();
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
        $user->status = 1;
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
        $emp = Employee::where('employeeUserId', $r->userId)->update(['fk_companyId'=> $r->companyId]);

        Session::flash('message', 'Employee Updated!');

        return back();
    }
}
