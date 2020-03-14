<?php

namespace App\Http\Controllers;

use App\Actions\BankStatementActions\InputBankStatementPost;
use App\Client;
use App\ClientAccountCode;
use App\GeneralLedger;
use App\Http\Requests\InputBSRequest;
use App\BankStatementInput;
use App\Jobs\CalculateGeneralLedgerBalance;
use App\Profession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class InputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(10);
        return view('admin.bs_input.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BankStatementInput  $input
     * @return \Illuminate\Http\Response
     */
    public function show(BankStatementInput $input)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BankStatementInput  $input
     * @return \Illuminate\Http\Response
     */
    public function edit(BankStatementInput $input)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BankStatementInput  $input
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankStatementInput $input)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BankStatementInput  $input
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankStatementInput $input)
    {
        //
    }

    public function showProfessions(Client $client)
    {
        //TO-DO
        //Permission Will be updated later
        if ($error = $this->sendPermissionError('admin.bs_import.index')) {
            return $error;
        }
        return view('admin.bs_input.select_profession',compact('client'));
    }

    public function inputBS(Client $client, Profession $profession)
    {
        $client_account_codes = ClientAccountCode::where('client_id',$client->id)->where('profession_id',$profession->id)->get();
        $inputs = BankStatementInput::with('client_account_code')
            ->where('client_id', $client->id)
            ->where('profession_id', $profession->id)
            ->where('is_posted', 0)
            ->get();
        $liquid_asset_account_codes = ClientAccountCode::where('additional_category_id',aarks('liquid_asset_id'))
            ->where('client_id',$client->id)
            ->where('profession_id',$profession->id)
            ->orderBy('code','asc')
            ->get();
        return view('admin.bs_input.input',compact('client','profession','client_account_codes', 'inputs','liquid_asset_account_codes'));
    }


    public function imp_tran_list_index()
    {
        $clients = Client::paginate(10);
        return view('admin.imp_tran_list.index',compact('clients'));
    }

    public function imp_tran_list_showProfessions(Client $client)
    {
        return view('admin.imp_tran_list.select_profession',compact('client'));
    }

    public function imp_tran_list(Client $client,Profession $profession)
    {
        $transactions = GeneralLedger::with('client_account_code')
            ->where('client_id',$client->id)
            ->where('profession_id',$profession->id)
            ->where('source','BST')
            ->where('transaction_for', aarks('general_ledger_transaction_for')['main'])
            ->paginate(20);
        return view('admin.imp_tran_list.list',compact('client','profession','transactions'));
    }

    public function bankStatementStore(InputBSRequest $request)
    {
        $bs_input = BankStatementInput::create([
            'account_code'  => $request->account_code,
            'date'          => Carbon::createFromFormat(aarks('frontend_date_format'), $request->date)->format(aarks('backend_date_format')),
            'debit'         => $request->debit ? : 0,
            'credit'        => $request->credit ? : 0,
            'client_id'     => $request->client_id,
            'profession_id' => $request->profession_id,
            'gst_code'      => $request->gst_code,
            'narration'     => $request->narration
        ]);
        $bs_input->load('client_account_code');
        return response()->json($bs_input,200);
    }

    public function bankStatementDelete(Request $request)
    {
        BankStatementInput::where('id', $request->id)->delete();
        return response()->json("Bank Statement Input Deleted",200);
    }

    public function post(Request $request, InputBankStatementPost $inputBankStatementPost)
    {
        $this->validate($request, [
            'bank_account' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $inputBankStatementPost->setClient(Client::find($request->client_id))
                ->setProfession(Profession::find($request->profession_id))
                ->setBankAccount(ClientAccountCode::find($request->bank_account))
                ->execute();

            Alert::success('Success','Action Successful');
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            Alert::error('Error',$exception->getMessage());
        }
        return back();
    }

    public function deleteFromTransList(GeneralLedger $generalLedger)
    {
        $client = Client::find($generalLedger->client_id);
        $profession = Profession::find($generalLedger->profession_id);
        GeneralLedger::where('transaction_id', $generalLedger->transaction_id)->delete();
        dispatch(new CalculateGeneralLedgerBalance($client, $profession));
        Alert::success('Success','Successfully Deleted');
        return back();
    }
}
