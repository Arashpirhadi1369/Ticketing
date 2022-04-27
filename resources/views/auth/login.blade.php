@extends('layouts.guest')
@section('login-content')


{{--Company Logo and Name--}}
<div class="mx-5 mt-5">
    <a class="d-flex flex-row align-content-center text-decoration-none text-dark">
        <img src="https://s6.uupload.ir/files/logo_o307.png">
        <div class="mr-2">
            <h3 class="text-demibold">شرکت ایران اینترنشنال</h3>
            <h5 class="text-small">ارائه دهنده راهکارهای اقتصادی</h5>
        </div>
    </a>ّ
</div>
<div class="card bg-light border-0  " >
    <div class="row no-gutters">
        <div class="card-body col-md-4 align-self-center">

            {{--Login User Container    --}}
            <div class="card bg-light mr-4 login-card">

                <div class="card-body shadow">
                    <div class="my-4 mr-3" >
                        <h3 class="text-black">خوش آمدید</h3>
                        <h6 class="">سامانه درخواست های واحد فناوری اطلاعات</h6>
                    </div>
                    <div class="dropdown-divider"></div>
                    <form method="post" action="{{route('login')}}">
                        @csrf
                        <!-- Username  -->
                        <div class="form-group d-flex flex-column ">
                            <div class="form-control bg-light input-group x-input my-2 ">
                                <div class="input-group-prepend ">
                                    <span class=" input-group-text bg-white border-left-0 pr-3" id="basic-addon1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="gray" class="bi bi-person-circle" viewBox="0 0 16 16">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                        </svg>
                                    </span>
                                </div>
                                <input type="text" class="form-control text-bold x-input border border-right-0" name="username" id="username" placeholder="کدکاربری">
                            </div>
                            <!--End Username  -->
                            <div class="form-control bg-light input-group x-input">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-left-0 pr-3" id="basic-addon1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="gray" class="bi bi-shield-lock" viewBox="0 0 16 16">
                                            <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                                            <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z" />
                                        </svg>
                                    </span>
                                </div>
                                <input type="password" class="form-control text-bold x-input border border-right-0 text-right " name="password" id="password" placeholder="کلمه عبور">
                            </div>
                        </div>

                        <!-- Validation Errors -->
                        @if($errors->any())
                        <div class="card border-danger mt-4 mx-3 mb-3">
                            <div class="card-body text-danger" style="background-color:#ffe7e9">
                                <x-auth-validation-errors class="mb-4 " :errors="$errors" />
                            </div>
                        </div>
                        @endif

                        {{-- <div class="form-group mr-3">
                            <a href="{{route('password.request')}}" class="text-bold mt-4 text-small text-primary">کلمه عبور خود را فراموش کرده ام ؟</a>
                        </div> --}}
                        <div class="form-group mx-3 ">
                            <button type="submit" class="btn mt-5 btn-lg my-3 btn-block btn-primary">ورود به سامانه</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="col-md-7 d-flex justify-content-center ">
            <img src="https://www.getillustrations.com/packs/plastic-illustrations-scene-builder-pack/scenes/_1x/accounts%20_%20man,%20workspace,%20desk,%20laptop,%20login,%20user_md.png">
        </div>
    </div>
</div>

@endsection




























{{--<x-guest-layout>--}}
{{-- <x-auth-card>--}}
{{-- <x-slot name="logo">--}}
{{-- <a href="/">--}}
{{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{-- </a>--}}
{{-- </x-slot>--}}

{{-- <!-- Session Status -->--}}
{{-- <x-auth-session-status class="mb-4" :status="session('status')" />--}}


{{-- <form method="POST" action="{{ route('login') }}">--}}
{{-- @csrf--}}

{{-- <!-- Email Address -->--}}
{{-- <div>--}}
{{-- <x-label for="username" :value="__('Username')" />--}}

{{-- <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />--}}
{{-- </div>--}}

{{-- <!-- Password -->--}}
{{-- <div class="mt-4">--}}
{{-- <x-label for="password" :value="__('Password')" />--}}

{{-- <x-input id="password" class="block mt-1 w-full"--}}
{{-- type="password"--}}
{{-- name="password"--}}
{{-- required autocomplete="current-password" />--}}
{{-- </div>--}}

{{-- <!-- Remember Me -->--}}
{{-- <div class="block mt-4">--}}
{{-- <label for="remember_me" class="inline-flex items-center">--}}
{{-- <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">--}}
{{-- <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{-- </label>--}}
{{-- </div>--}}

{{-- <div class="flex items-center justify-end mt-4">--}}
{{-- @if (Route::has('password.request'))--}}
{{-- <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">--}}
{{-- {{ __('Forgot your password?') }}--}}
{{-- </a>--}}
{{-- @endif--}}

{{-- <x-button class="ml-3">--}}
{{-- {{ __('Log in') }}--}}
{{-- </x-button>--}}
{{-- </div>--}}
{{-- </form>--}}
{{-- </x-auth-card>--}}
{{--</x-guest-layout>--}}
