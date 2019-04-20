<?php

namespace App\Http\Controllers;

use App\Client;
use App\Company;
use App\Department;
use App\Designation;
use App\Employee;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Yajra\DataTables\DataTables;

class ManageCompanyController extends Controller
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
            $this->user_company_id = Auth::user()->fkCompanyId;
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

    public function showmycompany(){
        $id = $this->getCompanyUserId();
        $company = Company::findOrFail($id);
        return view('ManageCompany.myCompany')->with('company', $company);
    }

    // show dept management page
    public function getDepartments(){
        $id = $this->getCompanyUserId();
        $departments = Department::where('company_id', $id)->get();
        return view('ManageCompany.Department.department')->with('company', $departments);
    }

    // show dept management page
    public function editDept(Request $r){
        $department = Department::where('dept_id', $r->dept_id)->first();
        return view('ManageCompany.Department.editDept')->with('department', $department);
    }

    // get all departments
    public function getAllDepartments(){
        $departments = Department::leftJoin('company', 'company.companyId', 'department.company_id')
                                  ->where('company_id', $this->getCompanyUserId())
                                  ->where('dept_deleted_at', null);

        $datatables = Datatables::of($departments);
        return $datatables->make(true);
    }


    // insert departments
    public function insertDept(Request $r){
        $dept = new Department();
        $dept->dept_name = $r->name;
        $dept->company_id = $this->getCompanyUserId();
        $dept->dept_info = $r->info;
        $dept->dept_created_at = date('Y-m-d H:i:s');
        $dept->save();

        Session::flash('message', 'New Department Created!');

        return back();
    }

    // update departments
    public function updateDept(Request $r){
        $dept = Department::findOrFail($r->id);
        $dept->dept_name = $r->name;
        $dept->dept_info = $r->info;
        $dept->save();

        Session::flash('message', 'Department Information Updated!');

        return back();
    }

    // delete departments
    public function deleteDept(Request $r){
        $dept = Department::findOrFail($r->id);
        $dept->dept_deleted_at = date('Y-m-d H:i:s');
        $dept->save();

        return back();
    }


    public function getDesignation()
    {
        return view('ManageCompany.Designation.designations');
    }

    // insert departments
    public function insertDesignation(Request $r){
        $desg = new Designation();
        $desg->designation_name = $r->title;
        $desg->company_id = $this->getCompanyUserId();
        $desg->save();

        Session::flash('message', 'New Designation Created!');

        return back();
    }

    // show dept management page
    public function editDesignation(Request $r){
        $desg = Designation::where('designation_id', $r->designation_id)->first();
        return view('ManageCompany.Designation.editDesignation')->with('desg', $desg);
    }

    // get all departments
    public function getAllDesignation(){
        $designations = Designation::leftJoin('company', 'company.companyId', 'designation.company_id')
                                    ->where('company_id', $this->getCompanyUserId())
                                    ->where('designation.deleted_at', null);

        $datatables = Datatables::of($designations);
        return $datatables->make(true);
    }

    // update designation
    public function updateDesignation(Request $r){
        $desg = Designation::findOrFail($r->id);
        $desg->designation_name = $r->name;
        $desg->save();

        Session::flash('message', 'Designation Information Updated!');

        return back();
    }

    // delete designation
    public function deleteDesignation(Request $r){
        $desg = Designation::findOrFail($r->id);
        $desg->deleted_at = date('Y-m-d H:i:s');
        $desg->save();

        return back();
    }

    /*  ADMIN MANAGEMENT */
    public function adminlist(){
        return view('ManageCompany.AdminManagement.adminlist');
    }

    public function getAdminData(){
        $adminList =  User::leftJoin('usertype','usertype.userTypeId','user.fk_userTypeId')
            ->leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')
            ->where('companyemployee.fk_companyId', $this->getCompanyUserId())
            ->where('user.fk_userTypeId', 4)
            ->get();

        $datatables = Datatables::of($adminList);
        return $datatables->make(true);
    }

    public function editAdmin(Request $r){

        $employee = User::where('userId',$r->admin_user_id)
            ->leftJoin('companyemployee', 'companyemployee.employeeUserId', 'user.userId')
            ->leftJoin('company', 'company.companyId', 'companyemployee.fk_companyId')
            ->first();

        return view('ManageCompany.AdminManagement.editAdmin')->with('employee', $employee);
    }
}
