<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientAccountCode;
use App\GeneralLedger;
use App\Http\Requests\ShowGeneralLedgerRequest;
use App\MasterAccountCode;
use App\Profession;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GeneralLedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('admin.general_ledger.index',compact('clients'));
    }

    public function showGeneralLedgerReport(Client $client , Profession $profession)
    {
        $client_account_codes = ClientAccountCode::where('client_id',$client->id)->where('profession_id',$profession->id)->orderBy('code','asc')->get();
        return view('admin.general_ledger.general_ledger_report',compact('profession','client','client_account_codes'));
    }

    public function showProfessions(Client $client){
        //TO-DO
        //Permission Will be updated later
        if ($error = $this->sendPermissionError('admin.bs_import.index')) {
            return $error;
        }
        return view('admin.general_ledger.select_profession',compact('client'));
    }

    public function showLedgerReport(ShowGeneralLedgerRequest $request)
    {
        $start_date = makeBackendCompatibleDate($request->start_date);
        $end_date = makeBackendCompatibleDate($request->end_date);

        $client_account_codes = ClientAccountCode::where('code', '>=',$request->from_account)
            ->where('code', '<=', $request->to_account)
            ->with(['generalLedger' => function ($query) use ($start_date, $end_date) {
                return $query->whereBetween('date', [$start_date, $end_date])->orderBy('date');
            }])
            ->where('client_id', $request->client_id)
            ->where('profession_id', $request->profession_id)
            ->orderBy('code')
            ->get();
        $client = Client::find($request->client_id);

        return view('admin.general_ledger.ledger_report',compact('start_date','end_date','client_account_codes','client'));
    }

    public function showTransaction($transaction_id)
    {
        $transactions = GeneralLedger::with('client_account_code')
            ->where('transaction_id', $transaction_id)->get();
        // $transactions = Transaction::where('transaction_id', $transaction_id)->get();
        return view('admin.general_ledger.show_transaction', compact('transactions'));
    }
}
