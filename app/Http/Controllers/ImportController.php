<?php

namespace App\Http\Controllers;

use App\Aarks\BankStatementImportCollection;
use App\Actions\BankStatementActions\ImportBankStatement;
use App\BankStatementImport;
use App\Client;
use App\ClientAccountCode;
use App\Http\Requests\BankStatementPostRequest;
use App\Http\Requests\UploadBSRequest;
use App\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class ImportController extends Controller
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
        $clients = Client::all();
        return view('admin.bs_import.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($error = $this->sendPermissionError('admin.bs_import.create')) {
            return $error;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UploadBSRequest $request
     * @param BankStatementImportCollection $bankStatementImport
     * @return \Illuminate\Http\Response
     */
    public function store(UploadBSRequest $request, BankStatementImportCollection $bankStatementImport)
    {
        if ($error = $this->sendPermissionError('admin.bs_import.create')) {
            return $error;
        }
        try {
            Excel::import($bankStatementImport, $request->file);
            $bankStatementImport->tempSolution($request->client_id, $request->profession_id);
            Alert::success('Upload Bank Statement','Bank statement was successfully uploaded');
        }catch (\Exception  $exception){
            Alert::error('Upload Bank Statement',$exception->getMessage());
        }

        return redirect()->route('bs_import.BS',['client' => $request->client_id,'profession' => $request->profession_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Import  $import
     * @return \Illuminate\Http\Response
     */
    public function show(BankStatementImport $import)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Import  $import
     * @return \Illuminate\Http\Response
     */
    public function edit(BankStatementImport $import)
    {
        if ($error = $this->sendPermissionError('admin.bs_import.edit')) {
            return $error;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Import  $import
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankStatementImport $import)
    {
        if ($error = $this->sendPermissionError('admin.bs_import.edit')) {
            return $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Import  $import
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankStatementImport $import)
    {
        //
    }

    public function showProfessions(Client $client)
    {
        if ($error = $this->sendPermissionError('admin.bs_import.index')) {
            return $error;
        }
        return view('admin.bs_import.select_profession',compact('client'));
    }

    public function showBS(Client $client,Profession $profession)
    {
        $bank_statements = BankStatementImport::where('is_posted',0)->with('client_account_code')
            ->where('client_id', $client->id)
            ->where('profession_id', $profession->id)
            ->paginate(10);
        $account_codes = ClientAccountCode::where('client_id',$client->id)->where('profession_id',$profession->id)->orderBy('code','asc')->get();
        $liquid_asset_account_codes = ClientAccountCode::where('additional_category_id',aarks('liquid_asset_id'))
            ->where('client_id',$client->id)
            ->where('profession_id',$profession->id)
            ->orderBy('code','asc')
            ->get();
        return view('admin.bs_import.import',compact('client','profession','bank_statements','account_codes','liquid_asset_account_codes'));
    }
    public function post(BankStatementPostRequest $request,ImportBankStatement $importBankStatement)
    {
        DB::beginTransaction();
        try {
            $importBankStatement->setClient(Client::find($request->client_id))
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
    public function deleteAll(Request $request)
    {
        DB::beginTransaction();
        try {
            BankStatementImport::where('is_posted',0)
                ->where('client_id',$request->client_id)
                ->where('profession_id',$request->profession_id)
                ->delete();
            Alert::success('Success','Action Successful');
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            Alert::error('Error',$exception->getMessage());
        }
        return back();
    }

    public function updateAccountCode(Request $request,$id)
    {
        try {
            $import = BankStatementImport::where('id',$id)->update(['account_code' => $request->accountCode]);
            return $import;
        }catch (\Exception $exception){
            return 0;
        }
    }
}
