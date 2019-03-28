<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectManagementController extends Controller
{
    // Project Management Dashboard
    public function projectmanagementDashboard(){
        return view('Project.ProjectManagement.projectList');
    }


    // Project Management
    public function projectmanagement(){
        return view('Project.ProjectManagement.newDashboard');
    }

    // Project Management
    public function projectmanagementold(){
        return view('Project.ProjectManagement.dashboard');
    }
}
