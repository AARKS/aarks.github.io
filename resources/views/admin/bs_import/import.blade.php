@extends('admin.layout.master')
@section('title','Import')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs" style="z-index: -1">
                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home home-icon"></i>
                                <a href="#">Home</a>
                            </li>

                            <li>
                                <a href="#">{{$client->first_name}}</a>
                            </li>
                            <li>
                                <a href="#">{{$profession->name}}</a>
                            </li>
                            <li class="active">Users List</li>
                        </ul><!-- /.breadcrumb -->
                    </div>
            <div class="page-content">

                <!-- Settings -->
            @include('admin.layout.settings')
            <!-- /Settings -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                            <div class="row" style="margin-top: 20px;">
                                <form action="{{route('bs_import.store')}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4">
                                        <input type="hidden" name="client_id" value="{{$client->id}}">
                                        <input type="hidden" name="profession_id" value="{{$profession->id}}">
                                        <input type="file" name="file" class="form-control">

                                        @if($errors->has('file'))
                                            <small class="text-danger">* {{$errors->first()}}</small>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <ul>
                                            <li style="list-style-type: none;color: red">File can only import if it is CSV(MS-DOS)/CSV(COMMA-delimited).</li>
                                            <li style="list-style-type: none"><a href="{{asset('files/example.csv')}}">Download file Format</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-primary" type="submit">Import</button>
                                    </div>
                                </form>
                            </div>
                        <hr>
                        <div class="row">
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center" style="width: 15%;">Account Name</th>
                                    <th class="center" style="width: 8%;">Date</th>
                                    <th class="center">Narration</th>
                                    <th class="center">Debit</th>
                                    <th class="center">Credit</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($bank_statements as $bank_statement)
                                        <tr>
                                            <td>
                                                <select class="form-control account_code" name="account_code" data-route="{{route('bs_import.updateCode', $bank_statement->id)}}">
                                                    <option>--</option>
                                                    <option value="" style="color: red">No Account Selected</option>
                                                    @foreach($account_codes as $account_code)
                                                        <option value="{{$account_code->id}}" style="color:{{$account_code->type == 1? '#f542e9': 'blue'}}"
                                                            @if($bank_statement->client_account_code && $bank_statement->client_account_code->code == $account_code->code) selected @endif>
                                                            {{$account_code->name}} - {{$account_code->code}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>{{$bank_statement->date->format(aarks('frontend_date_format'))}}</td>
                                            <td>{{$bank_statement->narration}}</td>
                                            <td>{{$bank_statement->debit}}</td>
                                            <td>{{$bank_statement->credit}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <span style="float: right;padding: 5px;"> {{$bank_statements->links()}}</span>
                        </div>
                        <hr>
                        <div class="row">
                            <form action="{{route('bs_import.post')}}" method="POST">
                                {{csrf_field()}}
                                <div class="col-md-4"></div>
                                <div class="col-md-2 text-success">
                                    Select Bank Account
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" name="bank_account" id="" style="width: 100%;">
                                        <option value="">Select Bank Account</option>
                                        @foreach($liquid_asset_account_codes as $liquid_asset_account_code)
                                            <option value="{{$liquid_asset_account_code->id}}">{{$liquid_asset_account_code->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('bank_account'))
                                        <small class="text-danger">* {{$errors->first()}}</small>
                                    @endif
                                </div>
                                <div class="col-md-1 text-right">
                                        <input type="hidden" name="client_id" value="{{$client->id}}">
                                        <input type="hidden" name="profession_id" value="{{$profession->id}}">
                                        <button type="submit" class="btn btn-primary" name="action" value="post" onclick="return confirmPost()">Post</button>
                                </div>
                                    </form>

                            <div class="col-md-1" style="">
                                <form action="{{route('bs_import.delete')}}" method="post">
                                    @method('DELETE')
                                    {{csrf_field()}}
                                    <input type="hidden" name="client_id" value="{{$client->id}}">
                                    <input type="hidden" name="profession_id" value="{{$profession->id}}">
                                    <button type="submit" class="btn btn-danger" name="action" value="delete">Delete All</button>
                                </form>
                            </div>
                        </div>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    <!-- Modal -->

    <script>
        $(document).ready(function () {
            $('.account_code').change(function () {
                var  accountCode = $(this).val();

                var  url = $(this).data('route');

                $.ajax({
                    url: url,
                    data: {"accountCode": accountCode},
                    method: "GET",
                    success: function (msg) {
                        if (msg == 1){
                            toast('success','Update Successful');
                        }else {
                            toast('error','Something is wrong');
                        }
                    }
                });
            });
        });

        function toast(status,header,msg) {

            //$.toast('Here you can put the text of the toast')
            Command: toastr[status](header, msg)

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "2000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
           }
        }

        function confirmPost() {
            var r = confirm("Are you sure?");
            if (r == false) {
               return false;
            }
        }
    </script>
@stop

