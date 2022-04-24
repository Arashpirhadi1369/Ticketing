@extends('layouts.guest')
@section('login-content')


    <div class="col-5 mt-5">
        <div class="jumbotron bg-transparent mb-0">
            <p class="h4 mb-4">کلمه عبور خود را فراموش کرده اید ...؟ </p>
            <p class="lead">نگران نباشید لطفا ایمیل خود را در قسمت تعیین شده وارد نمایید تا لینک بازیابی<br> کلمه عبور برای شما ارسال شود</p>
        </div>

        <div class="row mr-4 mb-2">
            <p class="h6">لطفا ایمیل خود را وارد نمایید</p>
        </div>
        @if (session('status'))
            <div>
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="post" class="mx-4 w-75">
            @csrf
            <div class="list-group shadow-sm">
                <div class="form-group list-group-item list-group-item-action mb-0">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent px-4 border-0 border-left-0 text-muted ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                                </svg>
                            </span>
                        </div>
                        <input style="background-color: white" id="email" class="form-control bg-transparent border-0 text-right focus:shadow-none" type="email" name="email"  required autofocus>
                    </div>
                </div>
            </div>
            <div class="form-group w-75 mt-3">
                <button class="btn btn-outline-success btn-lg">ارسال لینک بازیابی</button>
                <a href="{{route('login')}}" class="btn btn-danger btn-lg">انصراف</a>
            </div>

        </form>
    </div>

    <div class="col-7 d-flex justify-content-center ">
        <img src="https://s16.picofile.com/file/8428979134/2.png">
    </div>
@endsection










