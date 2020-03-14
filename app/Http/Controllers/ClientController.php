<?php namespace App\Http\Controllers;

use App\Actions\AccountCodeActions\CopyClientAccountCode;
use App\Actions\AccountCodeActions\DeleteClientAccountCode;
use App\Actions\ClientActions\AddClient;
use App\Actions\ClientActions\DeleteClient;
use App\Actions\ClientActions\EditClient;
use App\Client;
use App\Http\Requests\ClientCreateRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Profession;
use App\Service;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($error = $this->sendPermissionError('admin.client.index')) {
            return $error;
        }


        $clients = Client::all();
        return view('admin.client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($error = $this->sendPermissionError('admin.client.create')) {
            return $error;
        }

        $professions = Profession::select('id', 'name')->get();
        $services = Service::active()->select('name','id')->get();
        return view('admin.client.create',compact('services','professions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClientCreateRequest $request
     * @param AddClient $addClient
     * @param CopyClientAccountCode $copyClientAccountCode
     * @return \Illuminate\Http\Response
     */
    public function store(ClientCreateRequest $request, AddClient $addClient, CopyClientAccountCode $copyClientAccountCode)
    {
        if ($error = $this->sendPermissionError('admin.client.create')) {
            return $error;
        }

        $data = $this->prepareClientDataForCreate($request);

        DB::beginTransaction();

        try {
            $client = $addClient->setData($data)->execute();
            $copyClientAccountCode->setData(['profession_id' => $data['professions'],'client_id' => $client->id])->execute();
            Alert::success("Client Add", 'Client Successfully Inserted');
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Alert::error('Client Add', $exception->getMessage());
        }

        return redirect()->route('client.index');
    }

    public function prepareClientDataForCreate(ClientCreateRequest $request)
    {
        return [
            'company'          => $request->company,
            'contact_person'   => $request->contact_person,
            'first_name'       => $request->first_name,
            'last_name'        => $request->last_name,
            'birthday'         => $request->birthday,
            'phone'            => $request->phone,
            'abn_number'       => $request->abn_number,
            'branch'           => $request->branch,
            'tax_file_number'  => $request->tax_file_number,
            'street_address'   => $request->street_address,
            'state'            => $request->state,
            'post_code'        => $request->post_code,
            'director_name'    => $request->director_name,
            'director_address' => $request->director_address,
            'agent_name'       => $request->agent_name,
            'agent_address'    => $request->agent_address,
            'agent_number'     => $request->agent_number,
            'agent_abn_number' => $request->agent_abn_number,
            'auditor_name'     => $request->auditor_name,
            'auditor_address'  => $request->auditor_address,
            'auditor_phone'    => $request->auditor_phone,
            'email'            => $request->email,
            'suburb'           => $request->suburb,
            'country'          => $request->country,
            'gst_method'       => $request->gst_method,
            'is_gst_enabled'   => $request->is_gst_enabled,
            'password'         => bcrypt($request->password),
            'services'         => $request->services,
            'professions'      => $request->professions,
        ];
    }

    public function prepareClientDataForUpdate(ClientUpdateRequest $request)
    {
        $data = [
            'company'          => $request->company,
            'contact_person'   => $request->contact_person,
            'first_name'       => $request->first_name,
            'last_name'        => $request->last_name,
            'birthday'         => $request->birthday,
            'phone'            => $request->phone,
            'abn_number'       => $request->abn_number,
            'branch'           => $request->branch,
            'tax_file_number'  => $request->tax_file_number,
            'street_address'   => $request->street_address,
            'state'            => $request->state,
            'post_code'        => $request->post_code,
            'director_name'    => $request->director_name,
            'director_address' => $request->director_address,
            'agent_name'       => $request->agent_name,
            'agent_address'    => $request->agent_address,
            'agent_number'     => $request->agent_number,
            'agent_abn_number' => $request->agent_abn_number,
            'auditor_name'     => $request->auditor_name,
            'auditor_address'  => $request->auditor_address,
            'auditor_phone'    => $request->auditor_phone,
            'email'            => $request->email,
            'suburb'           => $request->suburb,
            'country'          => $request->country,
            'gst_method'       => $request->gst_method,
            'is_gst_enabled'   => $request->is_gst_enabled,
            'password'         => bcrypt($request->password),
            'services'         => $request->services,
            'professions'      => $request->professions,
        ];

        if(empty($request->password)){
            unset($data['password']);
        }

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        if ($error = $this->sendPermissionError('admin.client.edit')) {
            return $error;
        }
        $professions = Profession::select('id', 'name')->get();
        $services = Service::active()->select('name','id')->get();
        return view('admin.client.update',compact('client','services','professions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClientUpdateRequest $request
     * @param \App\Client $client
     * @param EditClient $editClient
     * @param CopyClientAccountCode $copyClientAccountCode
     * @param DeleteClientAccountCode $deleteClientAccountCode
     * @return \Illuminate\Http\Response
     */
    public function update(ClientUpdateRequest $request, Client $client, EditClient $editClient,CopyClientAccountCode $copyClientAccountCode,DeleteClientAccountCode $deleteClientAccountCode)
    {
        if ($error = $this->sendPermissionError('admin.client.edit')) {
            return $error;
        }
        $data = $this->prepareClientDataForUpdate($request);

        DB::beginTransaction();

        $previous_professions = $client->professions->pluck('id')->toArray();
        $profession_id_to_delete = array_diff($previous_professions,$data['professions']);
        $profession_id_to_add = array_diff($data['professions'],$previous_professions);

        try {
            $editClient->setInstance($client)->setData($data)->execute();
            $copyClientAccountCode->setData(['profession_id' => $profession_id_to_add,'client_id' => $client->id])->execute();
            $deleteClientAccountCode->setData($profession_id_to_delete,$client->id)->execute();
            Alert::success('Client Update', 'Client Successfully Updated');

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Alert::error('Client Update', $exception->getMessage());
        }

        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Client $client
     * @param DeleteClient $deleteClient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client,DeleteClient $deleteClient)
    {
        if ($error = $this->sendPermissionError('admin.client.delete')) {
            return $error;
        }

        DB::beginTransaction();
        try{
            $deleteClient->setClient($client)->execute();
            Alert::success('Client Delete', 'Client Successfully Deleted');
            DB::commit();
        }catch(\Exception $exception){
            DB::rollBack();
            Alert::error('Client Delete', $exception->getMessage());
        }
        return redirect()->route('client.index');
    }
}
