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
                        <a href="#">Business Activity</a>
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
                        <h1>Transaction View</h1>
                        <div class="row">
                            <table class="table table-bordered">
                                <thead>
                                <tr>

                                    <th class="center">SN</th>
                                    <th>Account Name</th>
                                    <th>Trn.Date</th>
                                    <th>Trn.ID</th>
                                    <th>Particular</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    {{--                                    <th class="center">Action</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sum = ['debit' => 0, 'credit' => 0];
                                @endphp
                                @foreach($transactions as $index => $transaction)
                                    @php
                                        $sum['debit'] += $transaction->debit;
                                        $sum['credit'] += $transaction->credit;
                                    @endphp
                                    <tr>
                                        <td class="center">{{ $index + 1 }}</td>
                                        <td>{{ $transaction->client_account_code->name }}</td>
                                        <td>{{ $transaction->date->format(aarks('frontend_date_format')) }}</td>
                                        <td>{{ makeNineDigitNumber($transaction->transaction_id) }}</td>
                                        <td>{{ $transaction->narration }}</td>
                                        <td>{{ $transaction->debit }}</td>
                                        <td>{{ $transaction->credit }}</td>
                                        {{--                                    <td class="center"> <i class='ace-icon fa fa-trash-o bigger-130 delete_link text-danger'></i></td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfooter>
                                    <tr>
                                        <td colspan="5" class="text-right"><b>Total</b></td>
                                        <td>{{ $sum['debit'] }}</td>
                                        <td>{{ $sum['credit'] }}</td>
                                        {{--                                        <td></td>--}}
                                    </tr>
                                </tfooter>
                            </table>
                        </div>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection
