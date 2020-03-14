@extends('admin.layout.master')
@section('title','General Ledger Page')
@section('content')

    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>

                    <li>
                        <a href="#">Report</a>
                    </li>
                    <li>
                        <a href="#">General Ledger</a>
                    </li>
                    <li>
                        <a href="#"></a>
                    </li>
                </ul><!-- /.breadcrumb -->
            </div>

            <div class="page-content">

                <!-- Settings -->
            {{--             <h1>Hello</h1>@include('admin.layout.settings')--}}
            <!-- /Settings -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                           <div class="row">
                               <h2 class="text-center bolder">{{$client->first_name}} {{$client->last_name}}</h2>
                               <h5 class="text-center"><u>Ledger Report From: {{$start_date->format('d-m-Y')}} to : {{$end_date->format('d-m-Y')}}</u></h5>
                           </div>

                        <div class="row text-right" style="display: none">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary">Send Email</button>
                                <button type="button" class="btn btn-primary">Print</button>
                            </div>
                        </div>

                        <div class="row">
                            <div>
                                <table class="table" style="margin: 10px;">
                                    @foreach($client_account_codes as $client_account_code)
                                    <tr>
                                        <td colspan="9" class="bolder" style="margin: 0;padding: 4px">{{$client_account_code->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Date</td>
                                        <td>Particular</td>
                                        <td class="center">Transaction Id</td>
                                        <td>JFL</td>
                                        <td>Dr.amount</td>
                                        <td>Cr.amount</td>
                                        <td>GST</td>
                                        <td>Net amt</td>
                                        <td>Balance</td>
                                    </tr>
                                    <tr>
                                        <td colspan="8">Opening Balance</td>
                                        @if ($client_account_code->generalLedger->count())
                                            @php
                                                $first_general_ledger = $client_account_code->generalLedger->first();
                                                $diff_balance = number_format($first_general_ledger->balance - $first_general_ledger->net_amount, 2);
                                                $balance = abs($diff_balance);
                                                $balance_type = ($diff_balance > 0 ? $first_general_ledger->balance_type : !$first_general_ledger->balance_type)
                                            @endphp
                                            @if ($balance != 0)
                                                <td>{{$balance . ' ' . ($balance_type ? 'Dr' : 'Cr')}}</td>
                                            @else
                                                <td>0</td>
                                            @endif
                                        @else
                                            <td>0</td>
                                        @endif
                                    </tr>

                                        @php
                                             $sum = ['debit' => 0, 'credit' => 0, 'net_amount' => 0,'gst' => 0]
                                        @endphp

                                        @foreach($client_account_code->generalLedger as $generalLedger)
                                            @php
                                                $sum['debit'] += $generalLedger->debit;
                                                $sum['credit'] += $generalLedger->credit;
                                                $sum['net_amount'] += $generalLedger->net_amount;
                                                $sum['gst'] += $generalLedger->gst;
                                            @endphp
                                        <tr>
                                            <td>{{$generalLedger->date->format(aarks('frontend_date_format'))}}</td>
                                            <td>{{$generalLedger->narration}}</td>
                                                <td class="center"><a href="{{route('show.general_ledger.transaction', $generalLedger->transaction_id)}}" style="color: green;text-decoration: underline">{{makeNineDigitNumber($generalLedger->transaction_id)}}</a></td>
                                            <td>{{$generalLedger->source}}</td>
                                            <td>{{$generalLedger->debit}}</td>
                                            <td>{{$generalLedger->credit}}</td>
                                            <td>{{$generalLedger->gst}}</td>
                                            <td>{{$generalLedger->net_amount}}</td>
                                            <td>{{$generalLedger->balance . ' ' . ($generalLedger->balance_type == 1 ? 'Dr' : 'Cr')}} </td>
                                        </tr>
                                        @endforeach
                                    <tr>
                                        <td>Total</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="color: red">{{ $sum['debit'] }}</td>
                                        <td style="color: red">{{ $sum['credit'] }}</td>
                                        <td style="color: red">{{ $sum['gst'] }}</td>
                                        <td style="color: red">{{ $sum['net_amount'] }}</td>
                                        <td></td>
                                    </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection
