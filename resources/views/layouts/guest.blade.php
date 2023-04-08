<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ticket') }}</title>
    <link rel="icon" href="{!! asset('images/title.png') !!}" />

    <!-- Fonts -->
    <link href="{{asset('css/fontiran.css')}}" rel="stylesheet" type="text/css" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{asset('/css/bootstrap-rtl.css') }}">
    <link rel="stylesheet" href="{{asset('/css/fontiranstyle.css') }}">
    <link rel="stylesheet" href="{{asset('/css/customstyle.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class=" " background="{{url('images/loginimages.png')}}" style="background-size:cover">
    <div class="">
        @yield('login-content')
    </div>
</body>

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.slim.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>

</html>