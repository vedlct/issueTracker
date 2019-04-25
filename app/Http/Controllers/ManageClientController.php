<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientContactPersonUserRelation;
use App\Company;
use App\Employee;
use App\SubCompany;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Session;

class ManageClientController extends Controller
{
    public $user_company_id;

    // GET USER'S COMPANY ID
    public function getCompanyUserId(){
        $this->user_company_id = Employee::where('employeeUserId', Auth::user()->userId)->first()->fk_companyId;
        return $this->user_company_id;
    }

    // SHOW CLIENT LIST PAGE
    public function clientList(){
        $company = Company::where('deleted_at', null)->get();
        return view('ManageClient.ClientManagement.clientlist')->with('companylist', $company);
    }

    // GET CLIENT INFORMATION
    public function getClientList(){
        $client = Client::where('clientCompanyId', $this->getCompanyUserId())
                        ->where('deleted_at', null);

        $datatables = Datatables::of($client);
        return $datatables->make(true);
    }

    // CLIENT INSERT
    public function insertClient(Request $r){
        $client = new Client();
        if($r->companyId)
        {
            $client->clientCompanyId = $r->companyId;
        }
        else
        {
            $client->clientCompanyId = $this->getCompanyUserId();
        }
        $client->clientName = $r->name;
        $client->clientEmail = $r->email;
        $client->clientInfo = $r->info;
        $client->created_at = date('Y-m-d H:i:s');
        $client->save();

        Session::flash('message', 'New Client Created!');

        return back();
    }

    // SHOW CLIENT CHANGE
    public function editClient(Request $r){
        $client = Client::where('clientId', $r->clientId)->first();
        return view('ManageClient.ClientManagement.editClient')->with('client', $client);
    }

    // CLIENT UPDATE
    public function updateClient(Request $r){
        $client = Client::findOrFail($r->clientId);
        $client->clientName = $r->name;
        $client->clientEmail = $r->email;
        $client->clientInfo = $r->info;
        $client->save();

        Session::flash('message', 'Client Information Updated!');

        return back();
    }

    // DELETE CLIENT
    public function deleteClient(Request $r){
        $client = Client::findOrFail($r->clientId);
        $client->deleted_at = date('Y-m-d H:i:s');
        $client->save();

        return back();
    }

    // SHOW CONTACT PERSON LIST
    public function contactPersonList($id){
        $client = Client::findOrFail($id);
        return view('ManageClient.ContactPersonManagement.contactPersonList')->with('client', $client);
    }

    // GET CONTACT PERSON DATA
    public function getcontactPersonList(Request $r){
        $contactPersons = User::leftJoin('clientContactPerson_user_relation', 'clientContactPerson_user_relation.person_userId', 'user.userId')
                              ->leftJoin('client', 'clientContactPerson_user_relation.clientId', 'client.clientId')
                              ->leftJoin('company', 'company.companyId', 'client.clientCompanyId')
                              ->where('clientContactPerson_user_relation.clientId', $r->client_id)
                              ->where('clientContactPerson_user_relation.deleted_at', null);

        $datatables = Datatables::of($contactPersons);
        return $datatables->make(true);
    }

    // CONTACT PERSON INSERT
    public function insertContactPerson(Request $r){

        $r->validate([
            'Password' => 'required|same:Confirm_Password'
        ]);

        // AS A USER
        $user = new User();
        $user->fullName = $r->name;
        $user->password = Hash::make($r->password1);
        $user->email = $r->email;
        $user->status = 1;
        $user->userPhoneNumber = $r->phone;
        $user->created_at = date('Y-m-d h:i:s');
        $user->updated_at = date('Y-m-d h:i:s');
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
        $contactPerson = new ClientContactPersonUserRelation();
        $contactPerson->clientId = $r->clientId;
        $contactPerson->person_userId = $user->userId;
        $contactPerson->created_at = date('Y-m-d h:i:s');
        $contactPerson->save();

        Session::flash('message', 'Contact Person Created!');

        return back();
    }

    // SHOW CLIENT CHANGE
    public function editContactPerson(Request $r){
        $contactPersons = User::findOrFail($r->person_userId);
        return view('ManageClient.ContactPersonManagement.editContactPerson')->with('user', $contactPersons);
    }

    public function updateContactPerson(Request $r){

        if($r->Password)
        {
            $r->validate([
                'Password' => 'required|same:Confirm_Password'
            ]);
        }

        // AS A USER
        $user = User::findOrFail($r->userId);
        $user->fullName = $r->name;
        if($r->Password)
        {
            $user->password = Hash::make($r->password1);
        }
        $user->email = $r->email;
        $user->status = 1;
        $user->userPhoneNumber = $r->phone;
        $user->updated_at = date('Y-m-d h:i:s');
        $user->save();

        if ($r->hasFile('profilePhoto')) {
            $file = $r->file('profilePhoto');
            $fileName = $user->userId . "." . $file->getClientOriginalExtension();
            $destinationPath = public_path('files/profileImage');
            $file->move($destinationPath, $fileName);
            $user->profilePhoto=$fileName;
            $user->save();
        }

        Session::flash('message', 'Contact Person Updated!');

        return back();
    }

    // DELETE CLIENT
    public function deleteContactPerson(Request $r){
        $user = User::findOrFail($r->userId);
        $user->deleted_at = date('Y-m-d h:i:s');
        $user->save();

        $contactPerson = ClientContactPersonUserRelation::where('person_userId', $r->userId)->first();
        $contactPerson->deleted_at = date('Y-m-d h:i:s');
        $contactPerson->save();

        return back();
    }


}
