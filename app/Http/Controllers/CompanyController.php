<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use Session;
use Yajra\DataTables\DataTables;
use Excel;
use App\Exports\CompanyExport;

class CompanyController extends Controller
{
    // view company list
    public function index(){
        return view('Company.all_company_list');
    }

    // get all Company
    public function getAllCompany(Request $r){
        $companies = Company::select('company.companyName','company.companyInfo','company.companyEmail','company.companyPhone1','company.companyId')
                                ->where('deleted_at', null);

        $datatables = Datatables::of($companies);
        return $datatables->make(true);
    }

    // view create company form
    public function create_company(){
        return view('Company.create_company');
    }

    // insert company
    public function insert_company(Request $r){

        $r->validate([
            'companyName' => 'required|max:45',
            'companyEmail' => 'required|unique:company,companyEmail',
        ]);

        $company = new Company();
        $company->companyName = $r->companyName;
        $company->companyInfo = $r->info;
        $company->companyAddress = $r->address;
        $company->companyPhone1 = $r->companyPhone1;
        $company->companyPhone2 = $r->companyPhone2;
        $company->companyEmail = $r->companyEmail;
        $company->created_at = date('Y-m-d');
        $company->save();

        Session::flash('message', 'Company Added!');

        return back();
    }

    // view edit company form
    public function edit_company($id){
        $company = Company::findOrFail($id);
        return view('Company.edit_company')->with('company', $company);
    }

    // Update company
    public function update_company(Request $r){

        $r->validate([
            'companyName' => 'required|max:45',
        ]);

        $company = Company::findOrFail($r->id);
        $company->companyName = $r->companyName;
        $company->companyInfo = $r->info;
        $company->companyAddress = $r->address;
        $company->companyPhone1 = $r->companyPhone1;
        $company->companyPhone2 = $r->companyPhone2;
        $company->companyEmail = $r->companyEmail;
        $company->save();

        Session::flash('message', 'Company Updated!');

        return back();
    }

    // Delete company
    public function delete_company(Request $r){
        $company = Company::findOrFail($r->id);
        $company->deleted_at = date('Y-m-d');
        $company->save();

        Session::flash('message', 'Company Deleted!');

        return back();
    }


    public function export()
    {
        return Excel::download(new CompanyExport, 'companylist.xlsx');
    }

    // SHOW ALL CLIENTS
    public function showAllclients($id){
        $company = Company::findOrFail($id);

//        $companylist = Company::where('deleted_at', null)->get();

        return view('Company.CompanyClientsManagement.allClients')->with('company', $company);
    }

    public function getAllclients(Request $r){
        $client = Client::where('clientCompanyId', $r->company_id)
                        ->where('deleted_at', null);

        $datatables = Datatables::of($client);
        return $datatables->make(true);
    }


}
