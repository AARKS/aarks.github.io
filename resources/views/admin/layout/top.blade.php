		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>@yield('title') | {{config('app.name')}}</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />



		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{ asset('admin/assets/font-awesome/4.5.0/css/font-awesome.min.css')}}" />

		<!-- Toastr -->
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

		<!-- page specific plugin styles -->
		<!-- Calendar -->
		<link rel="stylesheet" href="{{ asset('admin/assets/css/jquery-ui.custom.min.css')}}" />
		<link rel="stylesheet" href="{{ asset('admin/assets/css/fullcalendar.min.css')}}" />

		<!-- text fonts -->
		<link rel="stylesheet" href="{{ asset('admin/assets/css/fonts.googleapis.com.css')}}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{ asset('admin/assets/css/ace.min.css')}}" class="ace-main-stylesheet" id="main-ace-style" />

		<!-- Toastr CSS-->
		{{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css"> --}}

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="{{ asset('assets/css/ace-part2.min.css') }}" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="{{ asset('admin/assets/css/ace-skins.min.css')}}" />
		<link rel="stylesheet" href="{{ asset('admin/assets/css/ace-rtl.min.css')}}" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="{{ asset('assets/css/ace-ie.min.css') }}" />
		<![endif]-->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

		<!-- ace settings handler -->
		<script src="{{ asset('admin/assets/js/ace-extra.min.js')}}"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="{{ asset('assets/js/html5shiv.min.js') }}"></script>
		<script src="{{ asset('assets/js/respond.min.js') }}"></script>
		<![endif]-->


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

{{--        Toster--}}
        <link href="{{URL::to('public/tostr/toastr.css')}}" rel="stylesheet"/>
        <script src="{{URL::to('tostr/toastr.js')}}"></script>


{{--        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>--}}
{{--        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk="   crossorigin="anonymous"></script>--}}
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>--}}

{{--        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>--}}
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}


{{--        For Multi select         --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />


{{--        For Date Picker--}}
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

{{--        JS ALERT--}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>


{{--        Data Table--}}
        <script src="{{ asset('admin/assets/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('admin/assets/js/jquery.dataTables.bootstrap.min.js')}}"></script>
        <script src="{{ asset('admin/assets/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{ asset('admin/assets/js/dataTables.select.min.js')}}"></script>




{{--        <!-- ace scripts -->--}}
{{--        <script src="{{ asset('admin/assets/js/ace-elements.min.js')}}"></script>--}}
{{--        <script src="{{ asset('admin/assets/js/ace.min.js')}}"></script>--}}


        <script>
            window.date_format = "{{aarks('js_date_format')}}";
        </script>
