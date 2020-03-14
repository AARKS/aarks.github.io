<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Jobs\CalculateGeneralLedgerBalance;

$routes = [
    'admin'
];

foreach ($routes as $route) {
    require(__DIR__ . '/' . $route . '.php');
}


Route::get('test-general-ledger', function () {;
    $profession_id = 1;
    $client_id = 1;
    $profession = \App\Profession::find($profession_id);
    $client = \App\Client::find($client_id);
    dispatch(new CalculateGeneralLedgerBalance($client, $profession));
    dd("Queued");
    $data = \App\BankStatementImport::with('client_account_code')
        ->where('client_id', $client_id)
        ->where('profession_id', $profession_id)
        ->where('is_posted', 1)
        ->get()
        ->toArray();

    $general_ledger = new \App\Aarks\GeneralLedger\BankStatementImportGeneralLedger();
    $general_ledger->setProfession($profession);
    $general_ledger->setClient($client);
    $general_ledger->setOppositeAccountCode(\App\ClientAccountCode::find(4));
    $general_ledger->setData($data);
    dd($general_ledger);
});
