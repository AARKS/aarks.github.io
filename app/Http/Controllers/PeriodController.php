<?php namespace App\Http\Controllers;

use App\Actions\ClientPeriod\CreateClientPeriodAction;
use App\Client;
use App\Http\Requests\CreateClientPeriodRequest;
use App\Period;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use RealRashid\SweetAlert\Facades\Alert;

class PeriodController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkPassword')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($error = $this->sendPermissionError('admin.period.index')) {
            return $error;
        }
        return view('admin.period.search_financial_period_by_client');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateClientPeriodRequest $request
     * @param CreateClientPeriodAction $createClientPeriodAction
     * @return void
     */
    public function store(CreateClientPeriodRequest $request, CreateClientPeriodAction $createClientPeriodAction)
    {
        if ($error = $this->sendPermissionError('admin.period.create')) {
            return $error;
        }
       $data = $this->prepareDataForStorePeriod($request);

        try {
            $createClientPeriodAction->setData($data)->execute();
            Alert::success('Client Period','Client Period Recorded Successfully');

        }catch (\Exception $exception){
            Alert::error('Client Period',$exception->getMessage());
        }

        return redirect()->route('period.show',$request->client_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function show($client_id)
    {
        if ($error = $this->sendPermissionError('admin.period.show')) {
            return $error;
        }
        $client = Client::with('periods')->find($client_id);
        return view('admin.period.index',compact('client'));    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function edit(Period $period)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Period $period)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function destroy(Period $period)
    {
        if ($error = $this->sendPermissionError('admin.period.delete')) {
            return $error;
        }
        try {
            // TODO Some Checking need to do in future

            $period->delete();
            Alert::success('Client Period','Period Deleted Successfully');
        }catch (\Exception $exception){
            Alert::error('Client Period',$exception->getMessage());
        }
        return redirect()->route('period.show',$period->client_id);
    }

    public function prepareDataForStorePeriod($request)
    {
        return  [
            'year' => $request->year,
            'start_date' => makeBackendCompatibleDate($request->start_date),
            'end_date' => makeBackendCompatibleDate($request->end_date),
            'client_id' => $request->client_id
        ];
    }



    public function getClient(Request $request)
    {
        $clients = Client::where('first_name','like','%'.$request->q.'%')
            ->select('id', 'first_name', 'last_name')
            ->get()
            ->map(function ($client) {
                return [
                    'id' => route('period.show',$client->id),
                    "text" => $client->full_name
                ];
            })->toArray();

        return $clients;
    }
}
