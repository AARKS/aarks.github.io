@extends('admin.layout.master')
@section('title','Important Transaction List')
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
                        <a href="#">Add/Edit Data</a>
                    </li>
                    <li>
                        <a href="#">{{$client->first_name}} {{$client->first_name}}</a>
                    </li>
                    <li class="active">{{$profession->name}}</li>
                    <li>Import BankStatement List</li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
							<span class="input-icon">
								<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
								<i class="ace-icon fa fa-search nav-search-icon"></i>
							</span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">

                <!-- Settings -->
{{--            @include('admin.layout.settings')--}}
            <!-- /Settings -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <table class="table table-bordered">
                            <thead>
                                <th class="center">Transaction ID</th>
                                <th class="center">Transaction Date</th>
                                <th class="center">Account Code</th>
                                <th class="center" style="width: 40%;">Account Name</th>
                                <th class="center">Debit Amount</th>
                                <th class="center">Credit Amount</th>
                                <th class="center">Action</th>
                            </thead>
                            <tbody>
                                @forelse($transactions as $transaction)
                                    <tr>
                                        <td class="center">{{ makeNineDigitNumber($transaction->transaction_id) }}</td>
                                        <td class="center">{{ $transaction->date->format(aarks('frontend_date_format')) }}</td>
                                        <td class="center">{{ $transaction->client_account_code->code }}</td>
                                        <td class="center">{{ $transaction->narration }}</td>
                                        <td class="center">{{ $transaction->debit }}</td>
                                        <td class="center">{{ $transaction->credit }}</td>
                                        <td class="center">
                                            <a class="_delete" data-route="{{route('bs_input.imp_tran_list.delete', $transaction->id)}}"></a>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="6" class="text-center"><h4>No Data Found</h4></td>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $transactions->links() }}
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    <!-- Modal -->
@endsection
