<?php

namespace App\Http\Controllers;

use App\Client;
use App\Company;
use App\Department;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class ManageCompanyController extends Controller
{
    public $user_company_id;

    public function showmycompany(){
        $id = $this->getCompanyUserId();
        $company = Company::findOrFail($id);
        return view('ManageCompany.myCompany')->with('company', $company);
    }

    public function getDepartments(){
        $id = $this->getCompanyUserId();
        $departments = Department::where('company_id', $id)->get();
        return view('ManageCompany.Department.department')->with('company', $departments);
    }

    public function insertDept(Request $r){
        $dept = new Department();
        $dept->dept_name = $r->name;
        $dept->company_id = $this->getCompanyUserId();
        $dept->dept_info = $r->info;
        $dept->dept_created_at = date('Y-m-d H:i:s');
        $dept->save();

        Session::flash('message', 'New Department Created!');

        return redirect()->route('mycompany.departments');
    }

    // Get user's company user id
    public function getCompanyUserId(){

        if(Auth::user()->fk_userTypeId == 2)
        {
            $this->user_company_id = Client::where('userId', Auth::user()->userId)->first()->companyId;
        }
        if(Auth::user()->fk_userTypeId == 3)
        {
            $this->user_company_id = Employee::where('employeeUserId', Auth::user()->userId)->first()->fk_companyId;
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

}
