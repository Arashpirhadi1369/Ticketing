<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>
        <link rel="icon" href="{!! asset('images/Title.png') !!}" />
        
        <!-- Fonts -->
        <link href="{{asset('css/fontiran.css')}}" rel="stylesheet" type="text/css" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{asset('/css/bootstrap-rtl.css') }}">
        <link rel="stylesheet" href="{{asset('/css/fontiranstyle.css') }}">
        <link rel="stylesheet" href="{{asset('/css/customstyle.css') }}">

        <livewire:styles />
</head>

<body style="background-color: #DDDDDD;">
        <!-- Page Content -->
        <main class="max-height">
                {{$slot}}
        </main>
        <livewire:scripts />
</body>

<script src="{{asset('js/jquery.min.js')}}"></script>
{{-- <script src="{{asset('js/ajax-libs.min.js')}}"></script> --}}
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- Scripts -->
{{-- <script src="{{ mix('js/app.js') }}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.slim.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script> --}}

<script>
        window.addEventListener('closeModal', event => {
                document.getElementById('dashboardModalClose').click();
                document.getElementById('referredModalClose').click();
        })
</script>

</html>