<?php


Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/', function () {
    return view('auth.login');
});
Route::get('logout', '\App\Http\Controllers\LoginController@logout');
Route::post('login', '\App\Http\Controllers\LoginController@login')->name('login');

Route::group(['prefix' => 'client', 'as' => 'client' . '.'], function () {
    Route::get('dashboard', 'ClientDashboardController@index');
    Route::get('processes/{id}', 'ClientDashboardController@getProcessesOfClient')->name('processes');
    Route::get('advances/{id}', 'ClientDashboardController@getAdvancesOfClient')->name('advances');
    Route::get('stock/{id}', 'ClientDashboardController@getStockOfClient')->name('stock');
});
/*
|------------------------------------------------------------------------------------
| Admin
|------------------------------------------------------------------------------------
*/


Route::group(['prefix' => 'admin', 'as' => 'admin' . '.', 'middleware' => ['auth', 'Role:1']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dash');
    Route::post('updateProfile/{id}', 'UserController@updateProfile')->name('updateProfile');
    Route::get('editProfile/{id}', 'UserController@editProfile')->name('editProfile');
    Route::resource('users', 'UserController');

    //Client
    Route::get("client-processes/{id}", "clientsController@displayClientAdvances")->name("client.displayClientAdvances");
    Route::get("clients/processes/export/{client}", "clientsController@exportClientProcesses")->name("clients.exportClientProcesses");
    Route::get("clients/stock/export/{client}", "clientsController@exportClientStock")->name("clients.exportClientStock");
    Route::get("clients/advances/export/{client}", "clientsController@exportClientAdvances")->name("clients.exportClientAdvances");
    Route::get("clients/finances/export/{client}", "clientsController@exportClientFinances")->name("clients.exportClientFinances");
    Route::post("clients/send-sms", "clientsController@sendSmsMessageToClient")->name("clients.send-sms");
    Route::resource('clients', 'clientsController');
    //
    Route::get("advances/export" , "AdvanceController@exportAllToPdf")->name('advances.export');
    Route::resource('advances', 'AdvanceController');

    Route::get('invoices/exportToPdf/{invoice}', 'InvoiceController@exportInvoiceToPdf')->name("invoices.pdf");
    Route::post('invoices/getFiniacialStatusOfClient', 'InvoiceController@getFiniacialStatusOfClient');
    Route::resource('invoices', 'InvoiceController');
    Route::resource('setting', 'settingController');
    Route::resource('initialization', 'initializationController');
    Route::get('showDriver/{id}', 'driverController@showDriver')->name('showDriver');
    Route::resource('drivers', 'driverController');
    Route::resource('history', 'historyController');
    Route::post('processesUpdate/{id}', 'processesController@update')->name('processesUpdate');
    Route::get('getProcessById/{id}', 'processesController@getProcessById')->name('getProcessById');
    Route::post('exitProcess/{id}', 'processesController@exitProcess')->name('exitProcess');
    Route::get("processes/exportToPdf/{process}", "processesController@exportProcessToPdf")->name("processes.pdf");
    Route::get("processes/exportAllToPdf", "processesController@exportAllToPdf")->name("processes.export");
    Route::resource('processes', 'processesController');
    Route::post('updateProductsType', 'productsTypeController@update')->name('updateProductsType');
    Route::resource('productsType', 'productsTypeController');
    Route::post('typeUpdate', 'typesController@update')->name('typeUpdate');
    Route::get('getTypeByProduct/{proId}', 'typesController@getTypeByProduct')->name('getTypeByProduct');
    Route::resource('type', 'typesController');
    Route::post('sacksUpdate', 'sacksController@update')->name('sacksUpdate');
    Route::resource('sacks', 'sacksController');
    Route::post('floorsUpdate', 'floorController@update')->name('floorsUpdate');
    Route::resource('floors', 'floorController');
    Route::post('warehouseUpdate', 'warehouseController@update')->name('warehouseUpdate');
    Route::get('warehouseRelatedFloor/{id}', 'warehouseController@warehouseRelatedFloor')->name('warehouseRelatedFloor');
    Route::resource('warehouse', 'warehouseController');
    Route::resource('stock', 'stockController');
    Route::get('check-client-stock', 'processesController@checkClientAvailableStock');
    Route::post('Editseason', 'seasonsController@update')->name('Editseason');
    Route::resource('seasons', 'seasonsController');

    Route::get("expenses/export" , "ExpenseController@exportAllToPdf")->name('expenses.export');
    Route::resource('expenses', 'ExpenseController');
});
