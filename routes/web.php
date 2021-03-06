<?php

Auth::routes();

// Dashboard
Route::get('/','DashBoardController@index')->middleware('auth')->name('index');


Route::get('/call-all-ticket',    'DashBoardController@call_allticket')                ->name('call_allticket');
Route::get('/call-open-ticket',   'DashBoardController@call_openticket')               ->name('call_openticket');
Route::get('/call-close-ticket',  'DashBoardController@call_closeticket')              ->name('call_closeticket');
Route::get('/call-overdue-ticket','DashBoardController@call_overdueticket')            ->name('call_overdueticket');
Route::get('/call-pending-ticket','DashBoardController@call_pendingticket')            ->name('call_pendingticket');
Route::get('/all-notification/user','DashBoardController@showAllNotification')         ->name('show.allNotification');
Route::post('/get-all-notification-data','DashBoardController@getAllNotificationData') ->name('getMyallNotification');
Route::post('/change-unseen-notification','DashBoardComy-companyntroller@changeunseen')          ->name('notification.changeUnseen');


// Company
Route::get ('/company-list',     'CompanyController@index')          ->name('company.showAllCompany');
Route::post('/company-list',     'CompanyController@getAllCompany')  ->name('company.getAllCompany');
Route::get ('/create-company',   'CompanyController@create_company') ->name('company.create');
Route::post('/create-company',   'CompanyController@insert_company') ->name('company.insert');
Route::get ('/edit-company/{id}','CompanyController@edit_company')   ->name('company.edit');
Route::post('/edit-company/{id}','CompanyController@update_company') ->name('company.update');
Route::post('/company/delete',   'CompanyController@delete_company') ->name('company.delete');
Route::get ('/company-list',     'CompanyController@index')          ->name('company.showAllCompany');
Route::get ('/company-download', 'CompanyController@export')         ->name('company.export');



Route::get ('/company-clients/{id}', 'CompanyController@showAllclients')         ->name('company.show.clients');
Route::post('/get-company-clients',  'CompanyController@getAllclients')         ->name('company.get.clients');

// ManageCompanyController
Route::get ('/my-company',                          'ManageCompanyController@showmycompany')      ->name('mycompany');
Route::get ('/my-company/departments',              'ManageCompanyController@getDepartments')     ->name('mycompany.departments');
Route::post('/my-company/add/departments',          'ManageCompanyController@insertDept')         ->name('mycompany.department.insert');
Route::post('/my-company/get-all-departments',      'ManageCompanyController@getAllDepartments')  ->name('company.getAllDept');
Route::post('/my-company/change-department-info',   'ManageCompanyController@editDept')           ->name('dept.edit');
Route::post('/my-company/update-department-info',   'ManageCompanyController@updateDept')         ->name('dept.update');
Route::post('/my-company/delete-department-info',   'ManageCompanyController@deleteDept')         ->name('dept.delete');
Route::get ('/my-company/designations',             'ManageCompanyController@getDesignation')     ->name('mycompany.designation');
Route::post('/my-company/add/designations',         'ManageCompanyController@insertDesignation')  ->name('mycompany.designation.insert');
Route::post('/my-company/get-all-designations',     'ManageCompanyController@getAllDesignation')  ->name('company.getAllDesignation');
Route::post('/my-company/change-designations-info', 'ManageCompanyController@editDesignation')    ->name('designation.edit');
Route::post('/my-company/update-designations-info', 'ManageCompanyController@updateDesignation')  ->name('designation.update');
Route::post('/my-company/delete-designations-info', 'ManageCompanyController@deleteDesignation')  ->name('designation.delete');


Route::get ('/my-company/admin-management',          'ManageCompanyController@adminlist')     ->name('mycompany.adminlist');
Route::post('/my-company/get-admin-management-data', 'ManageCompanyController@getAdminData')  ->name('company.getAllAdmin');
Route::post('/my-company/get-edit-admin',            'ManageCompanyController@editAdmin')     ->name('mycompany.admin.edit');

// Project
Route::get ('/project-list',      'ProjectController@index')          ->name('project.showAllProject');
Route::post('/project-list',      'ProjectController@getAllProject')  ->name('project.getAllProject');
Route::post('/project-list2',      'ProjectController@getAllProject2')  ->name('project.getAllProject2');
Route::get ('/create-project',    'ProjectController@create_project') ->name('project.create');
Route::post('/create-project',    'ProjectController@insert_project') ->name('project.insert');
Route::get ('/edit-project/{id}', 'ProjectController@edit_project')   ->name('project.edit');


Route::post('/edit-project/{id}', 'ProjectController@update_project') ->name('project.update');
Route::post('/project/delete',    'ProjectController@delete_project') ->name('project.delete');
Route::post('/project/get-all-contact-person',    'ProjectController@getAllContactPerson') ->name('project.get.contactpersonlist');

Route::get ('/project-partner/delete/{id}', 'ProjectController@projectPartnerDelete')   ->name('project.partner.delete');
Route::get ('/project-partner/project-list', 'ProjectController@projectPartnerProjectList')   ->name('project.partner.showAllProject');
Route::post ('/project-partner/project-list', 'ProjectController@getAllprojectPartnerProjectList')   ->name('project.partner.getAllProject');




// Ticket
Route::get ('/ticket-list',               'TicketController@index')                    ->name('ticket.showAllCTicket');
Route::post('/ticket-list',               'TicketController@getAllTicket')             ->name('ticket.getAllTicket');
Route::post('/ticket-mylist',             'TicketController@getMyAllTicket')           ->name('ticket.getMyAllTicket');
Route::get ('/create-ticket',             'TicketController@createTicket')             ->name('ticket.create');
Route::post('/create-ticket',             'TicketController@insertTicket')             ->name('ticket.insert');
Route::get('/my-ticket',                  'TicketController@myTicket')                 ->name('ticket.myticket');

Route::post('/update-ticket-view-details','TicketController@returnCkEditorView')       ->name('ticket.ckEditorView');
Route::post('/update-ticket-details',     'TicketController@updateTicketDetails')      ->name('ticket.update.details');
Route::get ('/ticket-info/{id}',          'TicketController@showTicket')               ->name('ticket.view');
Route::post('/ticket-info/{id}',          'TicketController@insertReply')              ->name('ticket.reply.insert');
Route::post('/ticket-edit',               'TicketController@ticketEdit')               ->name('ticket.edit');
Route::post('/ticketInfo-edit',           'TicketController@ticketInfoEdit')           ->name('ticketInfo.edit');
Route::post('/ticketInfo/update',         'TicketController@ticketInfoUpdate')         ->name('ticket.info.update');
Route::post('/ticket/update',             'TicketController@updateTicketMain')         ->name('ticket.main.update');
Route::post('/ticket-report-download',    'TicketController@ticketExport')             ->name('ticket.report.generate');
Route::post('/ticket-list-filtered',      'TicketController@getAllTicketAfterFilter')  ->name('ticket.apply.filter');
Route::get ('/generate-excel',            'TicketController@showGenerateExcel')        ->name('ticket.show.generateExcel');
Route::post('/change-mass-ticket-type',   'TicketController@changeMassTicketStatus')   ->name('ticket.massChangeTicketStatus');
Route::post('/assign-ticket-team',        'TicketController@assignTicketToTeam')       ->name('ticket.massAssignTicket.team');
Route::post('/assign-ticket-individual',  'TicketController@assignTicketToIndividual') ->name('ticket.massAssignTicket.individual');
Route::post('/assign-ticket-remove',      'TicketController@assignTicketToNoOne')      ->name('ticket.massAssignTicket.none');


// Team Management
Route::get ('/assign-team',               'TeamManagementController@index')            ->name('assignteam.showAllteam');
Route::post('/insert-team',               'TeamManagementController@insertTeam')       ->name('team.insert');
Route::get ('/assignteam',                'TeamManagementController@assignTeamView')   ->name('team.assign');
Route::post('/insert-team-employee',      'TeamManagementController@teamAssign')       ->name('team.employee.insert');
Route::get ('/assign-team-members',       'TeamManagementController@teamMembers')      ->name('assign.team.member');
Route::post('/get-all-team-members',      'TeamManagementController@getAllTeamMembers')->name('getAllTeamMembers');
Route::post('/remove-employee-from-list', 'TeamManagementController@removeEmployee')   ->name('remove.employee');
Route::get ('/team-edit/{id}',            'TeamManagementController@teamEdit')         ->name('team.edit');
Route::post('/team-edit/{id}',            'TeamManagementController@teamUpdate')       ->name('team.update');
Route::get ('/team-work',                 'TeamManagementController@teamWork')         ->name('team.work');
Route::post('/team-work-data',            'TeamManagementController@teamWorkData')     ->name('team.work.data');

// User Management
Route::get ('/employee-list',       'UserManagementController@employeelist')       ->name('user.show.allEmployee');
Route::get ('/add-employee',        'UserManagementController@addEmployee')        ->name('user.add.employee');
Route::get ('/employee-make-manager/{id}',        'UserManagementController@employeeMakeManager')        ->name('employee.make.manager');
Route::get ('/employee-remove-manager/{id}',        'UserManagementController@employeeRemoveManager')        ->name('employee.remove.manager');
Route::post('/add-employee',        'UserManagementController@insertEmployee')     ->name('employee.insert');
Route::get ('/employee-edit/{id}',  'UserManagementController@editEmployee')       ->name('edit.employee.profile');
Route::post('/employee-update/',    'UserManagementController@updateEmployee')     ->name('employee.update');
Route::get ('/add-client',          'UserManagementController@addClient')          ->name('add.client');
Route::post('/add-client',          'UserManagementController@insertClient')       ->name('insert.client');
Route::get ('/client-list',         'UserManagementController@clientlist')         ->name('user.show.allClient');
Route::get ('/client-edit/{id}',    'UserManagementController@editClient')         ->name('edit.client.profile');
//Route::post('/client-update',       'UserManagementController@updateClient')       ->name('update.client.profile');
Route::get ('/add-company-admin',   'UserManagementController@addCompanyAdmin')    ->name('add.company.admin');
Route::post('/add-company-admin',   'UserManagementController@insertCompanyAdmin') ->name('company.admin.insert');
Route::get ('/admin-list',          'UserManagementController@adminList')          ->name('user.show.allAdmin');
Route::get ('/admin-edit/{id}',     'UserManagementController@editAdmin')          ->name('user.edit.admin');
Route::post('/admin-update/',       'UserManagementController@updateAdmin')        ->name('admin.update');
Route::post('/admin-delete/',       'UserManagementController@deleteAdmin')        ->name('user.delete.admin');


Route::get ('/today-work',                           'UserManagementController@today_work')         ->name('today.work');
Route::get ('/admin-add-employee-to-other-company/', 'UserManagementController@emp_to_manyCompany')         ->name('add.admin.otherCompany');
Route::post('/get-employee-all-data/',               'UserManagementController@getEmpList')                 ->name('get.all.EmpInfo');
Route::post('deleteFromCompany/',                    'UserManagementController@deleteFromCompany')          ->name('deleteFromCompany');
Route::post('employee/company/assign',               'UserManagementController@assignEmployeeCompany')      ->name('employee.company.insert');

// Profile Management
Route::get ('/profile', 'ProfileController@profile')    ->name('user.profile');
Route::post('/profile', 'ProfileController@updateProfile');


//==================================Project Management===============================
Route::get ('/project-management/dashboard',                 'ProjectManagementController@projectmanagementDashboard')->name('project.projectList');
Route::post ('/project-management/company/change',           'DashBoardController@changeCompany')                     ->name('company.change');
Route::post('/project-management/features-list',             'ProjectManagementController@getAllMyBacklog')           ->name('features.all');
Route::get ('/project-management/project-feature/{id}',      'ProjectManagementController@projectFeature')            ->name('project.features');
Route::post('/project-management/get-edit-backlog-data',     'ProjectManagementController@getEditModal')              ->name('backlog.dashboard.getEditModal');
Route::post('/project-management/update-backlog-data',       'ProjectManagementController@updateBacklogdata')         ->name('backlog.dashboard.updateData');
Route::post('/project-management/delete-backlog-data',       'ProjectManagementController@deleteBacklog')             ->name('backlog.dashboard.delete');
Route::get ('/project-management/project/{id}',              'ProjectManagementController@projectmanagement')         ->name('project.projectmanagement');
Route::get ('/project-management/project/information/{id}',  'ProjectManagementController@projectInformation')        ->name('project.Information');
Route::post('/project-management/backlog/insert',            'ProjectManagementController@insertBacklog')             ->name('backlog.insert');
Route::post('/project-management/backlog/edit',              'ProjectManagementController@returnEditBacklog')         ->name('backlog.edit');
Route::post('/project-management/backlog/update',            'ProjectManagementController@updateBacklog')             ->name('backlog.update');
Route::post('/project-management/backlog/comment',           'ProjectManagementController@postComment')               ->name('backlog.comment.post');
Route::post('/project-management/backlog/comment/load',      'ProjectManagementController@getComments')               ->name('backlog.comment.get');
Route::post('/project-management/backlog/generate-report',   'ProjectManagementController@generateReport')            ->name('backlog.generate.report');
Route::get ('/project-management/project/gantt-chart/{id}',  'ProjectManagementController@showGanttChart')            ->name('backlog.ganttChart');
Route::post('/project-management/dashboard/get-all-data',    'ProjectManagementController@getAllData')                ->name('backlog.dashboard.getallData');
Route::post('/project-management/backlog/continue',          'ProjectManagementController@backlogContinue')           ->name('backlog.continue');


Route::post('/project-management/dashboard/get-all-comments', 'ProjectManagementController@getAllMyComments')         ->name('backlog.show.getAllMyComments');
Route::post('/project-management/dashboard/get-all-owners',   'ProjectManagementController@getAllOwners')             ->name('backlog.show.owners');


//==================================Project backlog Management===============================
Route::get ('/project-management/backlog/{id}/dashboard',   'ProjectBacklogManagementController@dashboard')            ->name('backlog.dashboard');
Route::post('/project-management/backlog/get-backlog-data', 'ProjectBacklogManagementController@getAllBacklog')        ->name('backlog.dashboard.getAllBacklog');
Route::post('/project-management/backlog/details',          'ProjectBacklogManagementController@backlogDetails')       ->name('backlog.open.details');
Route::post('/project-management/backlog/details/update',   'ProjectBacklogManagementController@updateBacklogDetails') ->name('backlog.update.details');
Route::get ('/project-management/my-backlogs',              'ProjectBacklogManagementController@myblacklog')           ->name('project.BacklogManagement.todayWork');


//================================== ManageClientController ===============================
Route::get ('/client-list',         'ManageClientController@clientList')     ->name('client.list');
Route::post('/get-client-list',     'ManageClientController@getClientList')  ->name('client.getAllClient');
Route::post('/client-insert',       'ManageClientController@insertClient')   ->name('client.insert');
Route::post('/client-edit',         'ManageClientController@editClient')     ->name('client.edit');
Route::post('/client-update',       'ManageClientController@updateClient')   ->name('client.update');
Route::post('/client-delete',       'ManageClientController@deleteClient')   ->name('client.delete');


Route::get ('/client/contact-person-list/{id}',   'ManageClientController@contactPersonList')      ->name('client.show.contactPerson');
Route::post('/client/get-contact-person-list',    'ManageClientController@getcontactPersonList')   ->name('client.get.contactPerson');
Route::post('/client/insert-contact-person',      'ManageClientController@insertContactPerson')   ->name('client.insert.contactPerson');
Route::post('/client/edit-contact-person',        'ManageClientController@editContactPerson')     ->name('client.edit.contactPerson');
Route::post('/client/update-contact-person',      'ManageClientController@updateContactPerson')   ->name('client.update.contactPerson');

Route::post('/client/delete-contact-person',      'ManageClientController@deleteContactPerson')   ->name('client.delete.contactPerson');




// JoinRequestController
Route::get ('/send-request', 'JoinRequestController@index')->name('joinRequest');
Route::post('/send-request', 'JoinRequestController@insertRequest')->name('insert.joinRequest');

Route::get ('/all-requests', 'JoinRequestController@showAllRequest')->name('show.allRequest');

Route::post('/get-all-request', 'JoinRequestController@getAllRequest')->name('join.getAllJoinRequest');
Route::post('/show-request', 'JoinRequestController@showRequest')->name('join.request.show');
Route::post('/delete-request', 'JoinRequestController@deleteRequest')->name('join.request.delete');

// Project Proposal

Route::get ('/project-proposal', 'ProjectController@projectProposal')->name('project.proposal');
Route::post ('/project-proposal-submit', 'ProjectController@projectProposalSubmit')->name('project.proposal.submit');
Route::post ('/project-getProposed-Project', 'ProjectController@proposedProject')->name('project.getProposedProject');
Route::post ('/proposed-project-feature', 'ProjectController@proposedfeature')->name('proposed.project.feature');

// test purpose
Route::get('/project-management/test','ProjectController@test')->name('test');
