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
        $employeelist = DB::table('user')->leftJoin('usertype','usertype.userTypeId','user.fk_userTypeId')->get();
//        dd($employeelist);
        return view('Usermanagement.employeeList')->with('employeelist', $employeelist);
    }

    public function addEmployee(){
        $companylist = Company::all();
        return view('Usermanagement.addEmployee')->with('companyList', $companylist);
    }

    public function insertEmployee(Request $r){

//        dd($r);

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
}
