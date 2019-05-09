<?php

namespace App\Http\Controllers;

use App\JoinRequest;
use App\Notification;
use Illuminate\Http\Request;
use Session;
use Yajra\DataTables\DataTables;

class JoinRequestController extends Controller
{
    public function index()
    {
        return view('auth.accountRequest');
    }

    public function insertRequest(Request $r)
    {
        $r->validate([
            'email' => 'required|unique:joinRequest,company_email'
        ]);

        $joinRequest = new JoinRequest();
        $joinRequest->company_name = $r->companyName;
        $joinRequest->company_url = $r->url;
        $joinRequest->company_email = $r->email;
        $joinRequest->company_phone = $r->phone;
        $joinRequest->additional_info = $r->additionalInfo;
        $joinRequest->address = $r->address;
        $joinRequest->created_at = date('Y-m-d h:i:s');
        $joinRequest->save();

//        $notification = new Notification();
//        $notification->assigned_emp_id = $emp;
//        $notification->assigned_type = 'Backlog';
//        $notification->task_id = $backlog->backlog_id;
//        $notification->assigned_time = date('Y-m-d H:i:s');
//        $notification->seen = 0;
//        $notification->save();

        Session::flash('message', 'Request Sent Successfully. We will contact you soon.');

        return back();
    }

    public function showAllRequest()
    {
        return view('JoinRequest.allRequest');
    }

    public function getAllRequest()
    {
        $joinRequests = JoinRequest::where('deleted_at', null)->orderBy('created_at', 'desc')->get();
        $datatables = Datatables::of($joinRequests);
        return $datatables->make(true);
    }

    public function showRequest(Request $r)
    {
        $joinRequest = JoinRequest::findOrFail($r->id);
        return view('JoinRequest.showRequest')->with('req', $joinRequest);
    }

    public function deleteRequest(Request $r)
    {
        $joinRequest = JoinRequest::findOrFail($r->id);
        $joinRequest->deleted_at = date('Y-m-d h:i:s');
        $joinRequest->save();

        return back();
    }
}
