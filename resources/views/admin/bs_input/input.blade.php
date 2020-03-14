@extends('admin.layout.master')
@section('title','Input')
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
                        <a href="#">Add/Edit Data</a>
                    </li>
                    <li>
                        <a href="#">Bank Statement</a>
                    </li>

                    <li>
                        <a href="#">{{$client->first_name}}</a>
                    </li>
                    <li>
                        <a href="#">{{$profession->name}}</a>
                    </li>
                    <li class="active">Input Bank Statement</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">

                <!-- Settings -->
            @include('admin.layout.settings')
            <!-- /Settings -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                          <div style="margin: 5px">
                              <div class="row">
                                  <div class="col-md-2">
                                      Select Bank Account :-
                                  </div>
                                  <div class="col-md-3">
                                      <select class="form-control" name="" id="bank_account">
                                          <option>Select Bank Account</option>
                                          @foreach($liquid_asset_account_codes as $liquid_asset_account_code)
                                            <option value="{{$liquid_asset_account_code->id}}">{{$liquid_asset_account_code->name}}</option>
                                          @endforeach
                                      </select>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-12">
                                      <span>Entering Account Name:-</span>
                                  </div>
                                  <div class="col-md-12">
                                      <style>
                                          table,td,tr,th{
                                              border: 1px solid #dfe3eb;
                                              padding: 0;
                                              margin: 0;
                                          }
                                          .form-control{
                                              padding: 0;
                                              margin: 0;
                                          }
                                      </style>
                                      <table class="table">
                                          <tr style="">
                                              <th class="center" style="width: 10%;">A/c Code</th>
                                              <th class="center" style="width: 10%;">Trn. Date</th>
                                              <th class="center" style="width: 25%;">Narration</th>
                                              <th class="center" style="width: 10%;">Tx Code</th>
                                              <th class="center">Debit</th>
                                              <th class="center">Credit</th>
                                              <th class="center">(Excl Tax)</th>
                                              <th class="center">Tax</th>
                                              <th class="center">Action</th>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <select class="form-control" name="" id="account_code" required>
                                                      <option value="">--</option>
                                                      @foreach($client_account_codes as $client_account_code)
                                                          <option value="{{$client_account_code->id}}"
                                                                  data-gst="{{$client_account_code->gst_code}}"
                                                                  data-type="{{$client_account_code->type}}">
                                                          {{$client_account_code->name}} => {{$client_account_code->code}}</option>
                                                      @endforeach
                                                  </select>
                                              </td>
                                              <td>
                                                  <input class="form-control datepicker" id="date" type="text" required>
                                              </td>
                                              <td>
                                                  <input class="form-control" id="narration" type="text" required>
                                              </td>
                                              <td>
                                                  <select name="" id="gst_code" style="width: 100%;" required>
                                                      @foreach(aarks('gst_code') as $gst_code)
                                                        <option value="{{ $gst_code }}">{{$gst_code}}</option>
                                                      @endforeach
                                                  </select>
                                              </td>
                                              <td>
                                                  <input id="debit" class="form-control" type="number" disabled>
                                              </td>
                                              <td>
                                                  <input id="credit" class="form-control" type="number" disabled>
                                              </td>
                                              <td>
                                                  <input id="exTax" class="form-control" type="text" disabled>
                                              </td>
                                              <td>
                                                  <input id="tax" class="form-control" type="text" disabled>
                                              </td>
                                              <td class="center">
                                                  <button id="add" class="btn btn-secondary">Add</button>
                                              </td>
                                          </tr>
                                      </table>

                                     <div class="col-md-12">
                                         <form action="{{route('bank-statement.post')}}" method="POST">
                                             {{csrf_field()}}
                                             <input type="hidden" name="bank_account" id="post_bank_account">
                                             <input type="hidden" name="client_id" value="{{$client->id}}">
                                             <input type="hidden" name="profession_id" value="{{$profession->id}}">
                                             <button type="submit" class="btn btn-primary" style="float: right"> Post</button>
                                         </form>
                                     </div>

                                  </div>

                                  <div class="col-md-12">
                                      <form action="" style="margin-top: 50px;">
                                          <table class="table">
                                              <tr style="">
                                                  <th class="center" style="width: 10%;">A/c Code</th>
                                                  <th class="center" style="width: 10%;">Trn. Date</th>
                                                  <th class="center" style="width: 45%;">Narration</th>
                                                  <th class="center">Tx Code</th>
                                                  <th class="center">Debit</th>
                                                  <th class="center">Credit</th>
                                                  <th class="center">Action</th>
                                              </tr>
                                              <tbody id="result">
                                              @foreach($inputs as $input)
                                                  <tr id="input_row_{{$input->id}}">
                                                      <td>{{$input->client_account_code->name}}</td>
                                                      <td>{{ $input->date->format(aarks('frontend_date_format')) }}</td>
                                                      <td>{{ $input->narration }}</td>
                                                      <td style="width: 10%;">{{ $input->gst_code }}</td>
                                                      <td>{{ $input->debit }}</td>
                                                      <td>{{ $input->credit }}</td>
                                                      <td class="center">
                                                          <a class="fa fa-trash-o bigger-130 red"  style="cursor: pointer" onclick="confirm('Are you sure to delete?') ? deleteBankStatement('{{$input->id}}') : ''"></a>
                                                      </td>
                                                  </tr>
                                              @endforeach
                                              </tbody>
                                          </table>
                                      </form>
                                  </div>


                                  <script>
                                      $('#bank_account').change(function () {
                                           $('#post_bank_account').val($(this).val());
                                      });

                                      function deleteBankStatement(id) {
                                          var request = $.ajax({
                                              url: "{{route('bank-statement.delete')}}",
                                              method: "GET",
                                              data: {id : id},
                                          });

                                          request.done(function( response ) {
                                              alert('Successfully Deleted');
                                          });

                                          request.fail(function( jqXHR, textStatus ) {
                                              alert( "Request failed: " + textStatus );
                                          });
                                          $('#input_row_'+id).hide();
                                      }

                                      function openField(){
                                          let debit = $('#debit').val();
                                          let credit = $('#credit').val();
                                          if (debit == '' && credit == ''){
                                              $('#debit').prop('disabled',false);
                                              $('#credit').prop('disabled',false);
                                          }
                                          if (!debit == ''){
                                              $('#credit').prop('disabled',true);
                                          }
                                          if(!credit == ''){
                                              $('#debit').prop('disabled',true);
                                          }

                                      }
                                      $('#debit,#credit').keyup(function () {
                                          openField();
                                          let gst_code = $('#gst_code').val();
                                             let tax = $(this).val() && (gst_code == 'GST' || gst_code == 'INP' || gst_code == 'CAP') ? parseFloat($(this).val())/11 : 0;
                                             let exTax = $(this).val() ? parseFloat($(this).val())-tax : 0;
                                             $('#tax').val(tax.toFixed(2));
                                             $('#exTax').val(exTax.toFixed(2));
                                      });

                                      $('#account_code').change(function () {
                                          let type = $('#account_code option:selected').data('type');
                                          let gst_code = $('#account_code option:selected').data('gst');
                                          $("#gst_code option").each(function()
                                          {
                                              if($(this).val() == gst_code){
                                                  $(this).prop('selected', true);
                                              }
                                          });
                                          if(type == 1){
                                              $('#debit').prop('disabled',false);
                                              $('#credit').prop('disabled',true);
                                          }else{
                                              $('#debit').prop('disabled',true);
                                              $('#credit').prop('disabled',false);
                                          }
                                      });

                                      $('#add').click(function () {
                                          var data = getData();
                                          clear();
                                          var request = $.ajax({
                                              url: "{{route('bank-statement.store')}}",
                                              method: "GET",
                                              data: data,
                                          });

                                          request.done(function( response ) {
                                              let body = `<tr id="input_row_${response.id}">`+
                                                              '<td style="width: 20%;">'+response.client_account_code.name+'</td>'+
                                                              '<td>'+moment(response.date).format("DD/MM/YYYY")+'</td>'+
                                                              '<td>'+response.narration+'</td>'+
                                                              '<td style="width: 10%;">'+response.gst_code+'</td>'+
                                                              '<td>'+response.debit+'</td>'+
                                                              '<td>'+response.credit+'</td>'+
                                                              '<td class="center">'+
                                                                `<a class="fa fa-trash-o bigger-130 red" onclick="confirm('Are you sure to delete?') ? deleteBankStatement(${response.id}) : '' "></a>`+
                                                              '</td>'+
                                                          '</tr>';
                                              $('#result').append(body);
                                          });

                                          request.fail(function( jqXHR, textStatus ) {
                                              alert( "Request failed: " + textStatus );
                                          });

                                      });

                                      function getData() {
                                            return {
                                                'account_code': $('#account_code').val(),
                                                'narration' : $('#narration').val(),
                                                'date' : $('#date').val(),
                                                'debit': $('#debit').val(),
                                                'credit': $('#credit').val(),
                                                'client_id': '{{ $client->id }}',
                                                'profession_id': '{{ $profession->id }}',
                                                'gst_code': $('#gst_code').val(),
                                            };
                                      }

                                      function clear() {
                                          $('#account_code').val('');
                                          $('#narration').val('');
                                          $('#date').val('');
                                          $('#debit').val('');
                                          $('#credit').val('');
                                          $('#gst_code').val('');
                                          $('#exTax').val('');
                                          $('#tax').val('');
                                      }


                                  </script>

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
        $(".datepicker").datepicker({
            dateFormat: "dd/mm/yy",
            changeMonth: true,
            changeYear: true
        });
    </script>
@stop

