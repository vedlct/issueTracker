<?php


Route::get('/','DashBoardController@index')->middleware('auth')->name('index');

Auth::routes();

// Company
Route::get('/company-list','CompanyController@index')->name('company.showAllCompany');
Route::post('/company-list','CompanyController@getAllCompany')->name('company.getAllCompany');
Route::get('/create-company','CompanyController@create_company')->name('company.create');
Route::post('/create-company','CompanyController@insert_company')->name('company.insert');
Route::get('/edit-company/{id}','CompanyController@edit_company')->name('company.edit');
Route::post('/edit-company/{id}','CompanyController@update_company')->name('company.update');
Route::post('/company/delete','CompanyController@delete_company')->name('company.delete');

// Project
Route::get('/project-list','ProjectController@index')->name('project.showAllProject');
Route::post('/project-list','ProjectController@getAllProject')->name('project.getAllProject');
Route::get('/create-project','ProjectController@create_project')->name('project.create');
Route::post('/create-project','ProjectController@insert_project')->name('project.insert');
Route::get('/edit-project/{id}','ProjectController@edit_project')->name('project.edit');
Route::post('/edit-project/{id}','ProjectController@update_project')->name('project.update');
Route::post('/project/delete','ProjectController@delete_project')->name('project.delete');

// Ticket
Route::get('/ticket-list','TicketController@index')->name('ticket.showAllCTicket');
Route::post('/ticket-list','TicketController@getAllTicket')->name('ticket.getAllTicket');
Route::get('/create-ticket','TicketController@createTicket')->name('ticket.create');
Route::post('/create-ticket','TicketController@insertTicket')->name('ticket.insert');

Route::get('/ticket-info/{id}','TicketController@showTicket')->name('ticket.view');