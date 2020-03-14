@extends('admin.layout.master')
@section('title','Trial Balance Report')
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
                        <a href="#">Trial Balance Report</a>
                    </li>
                    <li>
{{--                        <a href="#">{{$client->first_name}}</a>--}}
                    </li>
                    <li>
{{--                        <a href="#">{{$profession->name}}</a>--}}
                    </li>
                </ul><!-- /.breadcrumb -->
            </div>

            <div class="page-content">

                <!-- Settings -->
            {{--            @include('admin.layout.settings')--}}
            <!-- /Settings -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                            <div class="row center">
                                <h2><b>{{$client->first_name}} {{$client->last_name}}</b></h2>
                                <h2><b>ABN {{$client->abn_number}}</b></h2>
                                <h4><b>Trial Balance as at: {{$date}}</b></h4>
                            </div>
                        <style>
                            .text-danger{
                                color: red;
                            }
                        </style>
                            <div class="row">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <td class="center">Account Code</td>
                                        <td class="center">Account Name</td>
                                        <td class="center">Debit</td>
                                        <td class="center">Credit</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $sum = ['debit'=> 0, 'credit'=> 0, 'income' => 0, 'expense' => 0];
                                    @endphp
                                    @foreach($trail_balance_reports as $report)
                                        @if (!$report->last_ledger)
                                            @continue
                                        @endif

                                        @php
                                            $sum['debit'] += $report->last_ledger->balance_type ? $report->last_ledger->balance : 0;
                                            $sum['credit'] += !$report->last_ledger->balance_type ? $report->last_ledger->balance : 0;
                                            $sum['income'] += $report->category_id == 1 ? $report->last_ledger->balance : 0;
                                            $sum['expense'] += $report->category_id == 3 ? $report->last_ledger->balance : 0;
                                        @endphp
                                        <tr>
                                            <td>{{$report->code}}</td>
                                            <td>{{$report->name}}</td>
                                            <td>{{$report->last_ledger->balance_type ? $report->last_ledger->balance : 0}}</td>
                                            <td>{{!$report->last_ledger->balance_type ? $report->last_ledger->balance : 0}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" class="text-right">Total</td>
                                        <td>{{$sum['debit']}}</td>
                                        <td>{{$sum['credit']}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-danger text-right">Difference between Dr. and Cr.</td>
                                        <td colspan="2" class="center text-danger">
                                            @php
                                                 echo withFinancialSign(abs($sum['debit'] - $sum['credit']));
                                            @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        @php
                                          $profit_or_loss = $sum['income'] - $sum['expense'];
                                        @endphp
                                        <td colspan="2" class="center text-right">Profit/Loss as at {{$date}}</td>
                                        <td colspan="2" class="center @if($profit_or_loss > 0) text-success @else text-danger @endif">{{ abs($profit_or_loss) }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row text-right">
                                <div class="btn-group btn-group">
                                    <button type="button" class="btn btn-primary">Print</button>
                                    <button type="button" class="btn btn-success">Send Email</button>
                                </div>
                            </div>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection
