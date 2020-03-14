<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.layout.top')
</head>

<body class="no-skin">
<!-- Header -->
@include('admin.layout.header')
<!-- /Header -->
<!-- Sweet Alert -->
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
<!-- Sweet Alert End -->

<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.loadState('main-container')
        } catch (e) {
        }
    </script>


    <!-- Navigation -->
@include('admin.layout.navigation')
<!-- /Navigation -->


    <!-- PAGE CONTENT BEGINS -->
@yield('content')


<!-- PAGE CONTENT ENDS -->

    <!-- Footer -->
@include('admin.layout.footer')
<!-- /Footer -->

    <script src="{{ asset('admin/assets/js/ace-elements.min.js?v='.assetVersion('ace_elements_min_js'))}}"></script>
    <script src="{{ asset('admin/assets/js/ace.min.js?v='.assetVersion('ace_min_js'))}}"></script>
    <script src="{{ asset('admin/assets/js/aarks.js?v='.assetVersion('aarks_js'))}}"></script>

@include('admin.common._delete')
@stack('custom_scripts')

</div><!-- /.col -->

</body>
</html>
