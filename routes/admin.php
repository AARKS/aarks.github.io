<?php

Route::get('/', function () {
    return view('welcome');
});
Route::get('admin/login', 'AdminController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'AdminController@login')->name('admin.login.post');

Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('dashboard', 'AdminDashboardController@dashboard')->name('admin.dashboard');
    Route::resource('profession', 'ProfessionController');
    Route::resource('client', 'ClientController');
    Route::get('account-code/search-by-profession','ProfessionAccountCodeController@showForm')->name('code');
    Route::get('master-chart','MasterChartController@showMasterChart')->name('master.chart');
    Route::delete('master-chart/delete-account-code','MasterChartController@delete')->name('delete.master.chart.account.code')->middleware('checkPassword');
    Route::get('master-chart/delete-sub-group','MasterChartController@deleteSubCategory')->name('delete.master.chart.sub.category');
    Route::delete('master-chart/additional_category/delete-sub-sub-group','MasterChartController@deleteAdditionalCategory')->name('delete.master.chart.additional.category')->middleware('checkPassword');
    Route::post('master-chart/sub-category','MasterChartController@addSubCategory')->name('create.master.sub.category');
    Route::post('master-chart/account-code','MasterChartController@addAccountCode')->name('create.master.account.code');
    Route::post('master-chart/account-code/edit','MasterChartController@editAccountCode')->name('edit.master.account.code');
    Route::post('master-chart/sub-sub-category','MasterChartController@addAdditionalCategory')->name('create.master.additional.category');
    Route::get('profession/{profession}/account-code','ProfessionAccountCodeController@index')->name('account-code.index');
    Route::post('generate/additional-category','AccountCodeCategoryController@generateAdditionalCategory')->name('create.additional.category');
    Route::post('account-code/sub-category','AccountCodeCategoryController@store')->name('create.sub.category');
    Route::post('generate/account-code','ProfessionAccountCodeController@store')->name('create.account.code');
    Route::delete('account-code/{profession_id}/{account_code}/delete','ProfessionAccountCodeController@delete')->name('delete.account.code')->middleware('checkPassword');
    Route::get('master-account-code-sync/{profession}', 'MasterChartController@sync')->name('master-account-code.sync');
    Route::post('account-code/edit','ProfessionAccountCodeController@editAccountCode')->name('edit.account.code');
    Route::resource('service','ServiceController');

    Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');

    Route::resource('user', 'AdminController');
    Route::get('user/{admin}/deactivate', 'AdminController@deactivate')->name('user.deactivate');
    Route::get('user/{admin}/reactivate', 'AdminController@reactivate')->name('user.reactivate');
    Route::resource('role', 'RoleController');
    Route::resource('period','PeriodController');
    Route::resource('bs_import','ImportController');
    Route::get('/bank-statement/bs_import/{client}','ImportController@showProfessions')->name('bs_import.professions');
    Route::get('/bank-statement/show/{client}/{profession}','ImportController@showBS')->name('bs_import.BS');
    Route::post('/bank-statement/statement/post','ImportController@post')->name('bs_import.post');
    Route::delete('/bank-statement/deleteAll','ImportController@deleteAll')->name('bs_import.delete');
    Route::get('/bank-statement/update-account-name/{id}','ImportController@updateAccountCode')->name('bs_import.updateCode');
    Route::resource('general_ledger','GeneralLedgerController');
    Route::get('/general-ledger/{client}','GeneralLedgerController@showProfessions')->name('general_ledger.professions');
    Route::get('/general-ledger/show/{client}/{profession}','GeneralLedgerController@showGeneralLedgerReport')->name('general_ledger.report');
    Route::get('/general-ledger','GeneralLedgerController@showLedgerReport')->name('show.general_ledger.report');
    Route::get('/general-ledger/transaction/{transaction_id}','GeneralLedgerController@showTransaction')->name('show.general_ledger.transaction');

    Route::resource('bs_input','InputController');
    Route::get('/bank-statement/bs_input/{client}','InputController@showProfessions')->name('bs_input.professions');
    Route::get('/bank-statement/bs_input/{client}/{profession}','InputController@inputBS')->name('bs_input.BS');

    Route::get('/bank-statement/input/imp_tran_list','InputController@imp_tran_list_index')->name('bs_input.imp_tran_list.index');
    Route::get('/bank-statement/input/{client}','InputController@imp_tran_list_showProfessions')->name('bs_input.imp_tran_list.professions');
    Route::get('/bank-statement/input/{client}/{profession}','InputController@imp_tran_list')->name('bs_input.imp_tran_list');
    Route::delete('/bank-statement/input/imp_tans_list/{generalLedger}/delete','InputController@deleteFromTransList')->name('bs_input.imp_tran_list.delete');

    Route::get('/bank-statement/store','InputController@bankStatementStore')->name('bank-statement.store');
    Route::get('/bank-statement/delete','InputController@bankStatementDelete')->name('bank-statement.delete');
    Route::post('/bank-statement/post','InputController@post')->name('bank-statement.post');


    Route::resource('trial-balance','TrialBalanceController');
    Route::get('/trial-balance/professions/{client}','TrialBalanceController@showProfessions')->name('trial-balance.professions');
    Route::get('/trial-balance/{client}/{profession}/select-date','TrialBalanceController@selectDate')->name('trial-balance.selectDate');
    Route::get('/trial-balance/{client}/{profession}/report/show','TrialBalanceController@trialBalanceReport')->name('trial-balance.report');

});


Route::middleware('auth:admin')->prefix('api')->group(function () {
    Route::get('check/account-code','AccountCodeValidationController@checkAccountCode')->name('check.account.code');
    Route::get('check/sub-category/account-code','AccountCodeValidationController@checkSubCategoryCode')->name('check.sub.category.account.code');
    Route::get('check/additional-category/account-code','AccountCodeValidationController@checkAdditionalCategoryCode')->name('check.additional.category.account.code');;
    Route::get('/clients','PeriodController@getClient');
});
