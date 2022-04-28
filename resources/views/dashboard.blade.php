@extends('layouts.app')
@section('dashboard')

        <div class="d-flex flex-row col">
            <div class=" bg-light shadow mt-4 mr-2 col-3 " id="navbar-dashboard">
                <div class="mx-4 pt-4 d-flex flex-row align-items-center">
                    <a class="d-flex flex-row align-items-center text-decoration-none text-dark">
                        <img class="" src="https://s6.uupload.ir/files/logo_o307.png" style="width: 40px ; height: 40px">
                        <div class="mr-2 mt-2">
                            <h5 class="text-demibold">شرکت ایران اینترنشنال</h5>
                            <h6 class="text-small">ارائه دهنده راهکارهای اقتصادی</h6>
                        </div>
                    </a>ّ
                </div>
                <div class="dropdown-divider mt-4"></div>
                <nav class="navbar navbar-expand-lg" >
                    <div class="dropdown-divider"></div>
                    <a class="navbar-brand"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse align-self-start mt-5 " id="navbarSupportedContent">
                        <ul class="navbar-nav d-flex flex-column">
                            <li class="nav-item  active">
                                <a class="nav-link d-flex text-dark align-items-center " href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="black" class="ml-3 bi bi-card-text" viewBox="0 0 16 16">
                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                        <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                    ثبت درخواست
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex text-dark align-items-center mt-3 " href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="black" class="ml-3 bi bi-person-lines-fill" viewBox="0 0 16 16">
                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                    </svg>
                                    مشاهده اطلاعات کاربری
                                </a>
                            </li>

                            <li class="nav-item my-3">
                                <a class="nav-link d-flex text-danger align-items-center text-bold" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="ml-2 bi bi-power" viewBox="0 0 16 16">
                                        <path d="M7.5 1v7h1V1h-1z"/>
                                        <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z"/>
                                    </svg>
                                    خروج
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="col-9 mt-4">
                @yield('dashboard-contents')
            </div>

        </div>
@endsection
