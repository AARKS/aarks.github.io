 <table id="dynamic-table" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>

            <th class="center">SN</th>
            <th>Company Name</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th class="hidden-480">E-mail</th>
            <th>{{$from == 'client_index'?'Mobile':'ABN Number'}}</th>
            @canany(['admin.client.edit','admin.bs_import.edit'])
                <th class="hidden-480">Action</th>
            @endcanany

        </tr>
        </thead>

        <tbody>

        @foreach($clients as $index => $row)
            <tr>
                <td class="center">{{ $index + 1 }}</td>
                <td>{{ $row->company }}</td>
                <td>{{ $row->first_name }}</td>
                <td>{{ $row->last_name }}</td>
                <td>{{ $row->email }}</td>
                @if($from == 'client_index')

                    <td>{{ $row->phone }}</td>
                    @canany(['admin.client.edit'])
                        <td>
                            <div>
                                <a class="green" href="{{ route('client.edit', $row->id) }}">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>||
                                <a class="_delete" data-route="{{route('client.destroy', $row->id)}}"></a>
                            </div>
                        </td>
                    @endcanany

                @elseif($from == 'import_index')

                    <td>{{ $row->abn_number }}</td>
                    @canany(['admin.bs_import.edit'])
                        <td>
                            <div>
                                <a class="orange" href="{{ route('bs_import.professions',$row->id)}}">
                                    Import/B/S
                                </a>
                            </div>
                        </td>
                    @endcanany
                @elseif($from == 'trial_balance_index')

                    <td>{{ $row->abn_number }}</td>
                    @canany(['admin.bs_import.edit'])
                        <td>
                            <div>
                                <a class="orange" href="{{ route('trial-balance.professions',$row->id)}}">
                                    Show Report
                                </a>
                            </div>
                        </td>
                    @endcanany
                @elseif($from == 'input_index')

                    <td>{{ $row->abn_number }}</td>
                    @canany(['admin.bs_import.edit'])
                        <td>
                            <div>
                                <a class="orange" href="{{ route('bs_input.professions',$row->id)}}">
                                   Input Bank Statement
                                </a>
                            </div>
                        </td>
                    @endcanany

                @elseif($from == 'imp_tran_list')

                    <td>{{ $row->abn_number }}</td>
                    @canany(['admin.bs_import.edit'])
                        <td>
                            <div>
                                <a class="orange" href="{{ route('bs_input.imp_tran_list.professions',$row->id)}}">
                                    Show Report
                                </a>
                            </div>
                        </td>
                    @endcanany

                @else
                    <td>{{ $row->abn_number }}</td>
                    @canany(['admin.bs_import.edit'])
                        <td>
                            <div>
                                <a class="orange" href="{{ route('general_ledger.professions',$row->id)}}">
                                    Show Report
                                </a>
                            </div>
                        </td>
                    @endcanany
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>

