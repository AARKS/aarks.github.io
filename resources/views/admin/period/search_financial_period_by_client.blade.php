@extends('admin.layout.master')

@section('title', 'Go to Period')

@section('content')

    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                </script>

                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>

                    <li>
                        <a href="#">Select Client</a>
                    </li>
                </ul><!-- /.breadcrumb -->
            </div>
        </div>
        <!-- Settings -->
    @include('admin.layout.settings')
    <!-- /Settings -->

        <div class="page-content">
            <div class="row">
                <div class="col-md-3">
                    <h2>Select Client</h2>
                </div>

                <div class="col-md-4" style="padding-top:20px;">
                    <form action="#" name="topform">
                        <div class="form-group">
                            <select class="form-control" id="select-client" onchange="location = this.value">
                                <option> Select a Client</option>
                            </select>
                        </div>
                    </form>
                    <script>
                        $('#select-client').select2({
                            ajax               : {
                                url            : '/api/clients',
                                type           : 'get',
                                dataType       : 'json',
                                delay          : 250,
                                processResults : function (data) {
                                    return {
                                        results : data
                                    };
                                },
                                cache:true,
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

@stop
