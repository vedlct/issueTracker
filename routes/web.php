<?php

// Dashboard
Route::get('/','DashBoardController@index')->middleware('auth')->name('index');

Route::get('/call-all-ticket','DashBoardController@call_allticket')->name('call_allticket');
Route::get('/call-open-ticket','DashBoardController@call_openticket')->name('call_openticket');
Route::get('/call-close-ticket','DashBoardController@call_closeticket')->name('call_closeticket');
Route::get('/call-overdue-ticket','DashBoardController@call_overdueticket')->name('call_overdueticket');
Route::get('/call-pending-ticket','DashBoardController@call_pendingticket')->name('call_pendingticket');






Auth::routes();

// Company
Route::get('/company-list','CompanyController@index')->name('company.showAllCompany');
Route::post('/company-list','CompanyController@getAllCompany')->name('company.getAllCompany');
Route::get('/create-company','CompanyController@create_company')->name('company.create');
Route::post('/create-company','CompanyController@insert_company')->name('company.insert');
Route::get('/edit-company/{id}','CompanyController@edit_company')->name('company.edit');
Route::post('/edit-company/{id}','CompanyController@update_company')->name('company.update');
Route::post('/company/delete','CompanyController@delete_company')->name('company.delete');
Route::get('/company-list','CompanyController@index')->name('company.showAllCompany');
Route::get('/company-download','CompanyController@export')->name('company.export');


// Project
Route::get('/project-list','ProjectController@index')->name('project.showAllProject');
Route::post('/project-list','ProjectController@getAllProject')->name('project.getAllProject');
Route::get('/create-project','ProjectController@create_project')->name('project.create');
Route::post('/create-project','ProjectController@insert_project')->name('project.insert');
Route::get('/edit-project/{id}','ProjectController@edit_project')->name('project.edit');
Route::post('/edit-project/{id}','ProjectController@update_project')->name('project.update');
Route::post('/project/delete','ProjectController@delete_project')->name('project.delete');


Route::get('/project-management/dashboard','ProjectController@projectmanagement')->name('project.projectmanagement');

//Route::get('/project-management/dashboard', function () {
//    return view('Project.ProjectManagement.dashboard');
//});


// Ticket
Route::get('/ticket-list','TicketController@index')->name('ticket.showAllCTicket');
Route::post('/ticket-list','TicketController@getAllTicket')->name('ticket.getAllTicket');
Route::get('/create-ticket','TicketController@createTicket')->name('ticket.create');
Route::post('/create-ticket','TicketController@insertTicket')->name('ticket.insert');
Route::post('/update-ticket-view-details','TicketController@returnCkEditorView')->name('ticket.ckEditorView');
Route::post('/update-ticket-details','TicketController@updateTicketDetails')->name('ticket.update.details');
Route::get('/ticket-info/{id}','TicketController@showTicket')->name('ticket.view');
Route::post('/ticket-info/{id}','TicketController@insertReply')->name('ticket.reply.insert');
Route::post('/ticket-edit','TicketController@ticketEdit')->name('ticket.edit');
Route::post('/ticket/update','TicketController@updateTicketMain')->name('ticket.main.update');
Route::post('/ticket-report-download','TicketController@ticketExport')->name('ticket.report.generate');
Route::post('/ticket-list-filtered','TicketController@getAllTicketAfterFilter')->name('ticket.apply.filter');
Route::get('/generate-excel', 'TicketController@showGenerateExcel')->name('ticket.show.generateExcel');

Route::post('/change-mass-ticket-type', 'TicketController@changeMassTicketStatus')->name('ticket.massChangeTicketStatus');
Route::post('/assign-ticket-team', 'TicketController@assignTicketToTeam')->name('ticket.massAssignTicket.team');
Route::post('/assign-ticket-individual', 'TicketController@assignTicketToIndividual')->name('ticket.massAssignTicket.individual');
Route::post('/assign-ticket-remove', 'TicketController@assignTicketToNoOne')->name('ticket.massAssignTicket.none');


// Team Management
Route::get('/assign-team', 'TeamManagementController@index')->name('assignteam.showAllteam');
Route::post('/insert-team', 'TeamManagementController@insertTeam')->name('team.insert');
Route::get('/assignteam', 'TeamManagementController@assignTeamView')->name('team.assign');
Route::post('/insert-team-employee', 'TeamManagementController@teamAssign')->name('team.employee.insert');
Route::get('/assign-team-members', 'TeamManagementController@teamMembers')->name('assign.team.member');
Route::post('/get-all-team-members', 'TeamManagementController@getAllTeamMembers')->name('getAllTeamMembers');
Route::post('/remove-employee-from-list', 'TeamManagementController@removeEmployee')->name('remove.employee');
Route::get('/team-edit/{id}', 'TeamManagementController@teamEdit')->name('team.edit');
Route::post('/team-edit/{id}', 'TeamManagementController@teamUpdate')->name('team.update');

// User Management
Route::get('/employee-list', 'UserManagementController@employeelist')->name('user.show.allEmployee');
Route::get('/add-employee', 'UserManagementController@addEmployee')->name('user.add.employee');
Route::post('/add-employee', 'UserManagementController@insertEmployee')->name('employee.insert');
Route::get('/employee-edit/{id}', 'UserManagementController@editEmployee')->name('edit.employee.profile');
Route::post('/employee-update/', 'UserManagementController@updateEmployee')->name('employee.update');
Route::get('/add-client', 'UserManagementController@addClient')->name('add.client');
Route::post('/add-client', 'UserManagementController@insertClient')->name('insert.client');
Route::get('/client-list', 'UserManagementController@clientlist')->name('user.show.allClient');
Route::get('/client-edit/{id}', 'UserManagementController@editClient')->name('edit.client.profile');
Route::post('/client-update', 'UserManagementController@updateClient')->name('update.client.profile');
Route::get('/add-company-admin', 'UserManagementController@addCompanyAdmin')->name('add.company.admin');
Route::post('/add-company-admin', 'UserManagementController@insertCompanyAdmin')->name('company.admin.insert');
Route::get('/admin-list', 'UserManagementController@adminList')->name('user.show.allAdmin');
Route::get('/admin-edit/{id}', 'UserManagementController@editAdmin')->name('user.edit.admin');
Route::post('/admin-update/', 'UserManagementController@updateAdmin')->name('admin.update');


// Profile Management
Route::get('/profile', 'ProfileController@profile')->name('user.profile');
Route::post('/profile', 'ProfileController@updateProfile');










