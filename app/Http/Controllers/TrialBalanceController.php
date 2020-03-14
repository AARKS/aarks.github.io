<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientAccountCode;
use App\GeneralLedger;
use App\Profession;
use App\Transaction;
use App\TrialBalance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrialBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($error = $this->sendPermissionError('admin.bs_import.index')) {
            return $error;
        }
        //Permission Will be changed
        $clients = Client::all();
        return view('admin.trial_balance.index',compact('clients'));
    }

    public function showProfessions(Client $client)
    {
        if ($error = $this->sendPermissionError('admin.bs_import.index')) {
            return $error;
        }
        return view('admin.trial_balance.select_profession',compact('client'));
    }

    public function selectDate(Client $client,Profession $profession)
    {
        return view('admin.trial_balance.select_date',compact('client','profession'));
    }

    public function trialBalanceReport(Client $client, Profession $profession, Request $request)
    {
        $date = makeBackendCompatibleDate($request->date)->format(aarks('backend_date_format'));

        $trail_balance_reports = ClientAccountCode::where('client_id', $client->id)
            ->where('profession_id', $profession->id)
            ->orderBy('code')->get()->each(function ($client_account_code) use ($date) {
                $client_account_code->last_ledger = $client_account_code->getGeneralLedgerOfDate($date);
            });

        $date = Carbon::parse($date)->format(aarks('frontend_date_format'));
        return view('admin.trial_balance.report',compact('trail_balance_reports','date','client'));
    }
}
