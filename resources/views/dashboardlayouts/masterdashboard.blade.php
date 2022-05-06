@extends('layouts.app')
@section('dashboard')

    <div class="d-flex ">

        <div class="col-3 my-4" id="navbar-dashboard" >
            <div class=" bg-light shadow  mr-2 " id="navbar-dashboard"  >
                <div class="mx-4 pt-4 d-flex flex-row align-items-center">
                    <a class="d-flex flex-row align-items-center text-decoration-none text-dark">
                        <img class="" src="{{url('images/logo.png')}}" style="width: 4rem ; height: 2rem">
                        <div class="mr-2 mt-2">
                            <h5 class="text-demibold company-text" >شرکت محافظان بهبود آب</h5>
                            <h6 class="text-small company-text">MBA Water Treatment Chemicals</h6>
                        </div>
                    </a>
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
                                <a class="nav-link d-flex text-dark align-items-center" href={{route('dashboard')}}>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="black" class="ml-3 bi bi-card-text" viewBox="0 0 16 16">
                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                        <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                    ثبت درخواست
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex text-dark align-items-center mt-3 " data-toggle="collapse"
                                   href="#collapseExample" role="button" aria-expanded="true" aria-controls="collapseExample">
                                    <svg width="25" height="25" fill="balck" class="ml-3 bi"
                                         xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                                        <path d="M20 24h-20v-22h3c1.229 0 2.18-1.084 3-2h8c.82.916 1.771 2 3 2h3v9h-2v-7h-4l-2 2h-3.898l-2.102-2h-4v18h16v-5h2v7zm-10-4h-6v-1h6v1zm0-2h-6v-1h6v1zm6-5h8v2h-8v3l-5-4 5-4v3zm-6 3h-6v-1h6v1zm0-2h-6v-1h6v1zm0-2h-6v-1h6v1zm0-2h-6v-1h6v1zm-1-7c0 .552.448 1 1 1s1-.448 1-1-.448-1-1-1-1 .448-1 1z"/></svg>
                                    گزارشات
                                </a>
                                <div class="collapse" id="collapseExample">

                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex text-dark align-items-center mt-3 " href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="black" class="ml-3 bi bi-person-lines-fill" viewBox="0 0 16 16">
                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                    </svg>
                                    مشاهده اطلاعات کاربری
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex text-dark align-items-center mt-3 " href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="balck" class="ml-3 bi" viewBox="0 0 24 24"><path d="M17 10.645v-2.29c-1.17-.417-1.907-.533-2.28-1.431-.373-.9.07-1.512.6-2.625l-1.618-1.619c-1.105.525-1.723.974-2.626.6-.9-.373-1.017-1.116-1.431-2.28h-2.29c-.412 1.158-.53 1.907-1.431 2.28h-.001c-.9.374-1.51-.07-2.625-.6l-1.617 1.619c.527 1.11.973 1.724.6 2.625-.375.901-1.123 1.019-2.281 1.431v2.289c1.155.412 1.907.531 2.28 1.431.376.908-.081 1.534-.6 2.625l1.618 1.619c1.107-.525 1.724-.974 2.625-.6h.001c.9.373 1.018 1.118 1.431 2.28h2.289c.412-1.158.53-1.905 1.437-2.282h.001c.894-.372 1.501.071 2.619.602l1.618-1.619c-.525-1.107-.974-1.723-.601-2.625.374-.899 1.126-1.019 2.282-1.43zm-8.5 1.689c-1.564 0-2.833-1.269-2.833-2.834s1.269-2.834 2.833-2.834 2.833 1.269 2.833 2.834-1.269 2.834-2.833 2.834zm15.5 4.205v-1.077c-.55-.196-.897-.251-1.073-.673-.176-.424.033-.711.282-1.236l-.762-.762c-.52.248-.811.458-1.235.283-.424-.175-.479-.525-.674-1.073h-1.076c-.194.545-.25.897-.674 1.073-.424.176-.711-.033-1.235-.283l-.762.762c.248.523.458.812.282 1.236-.176.424-.528.479-1.073.673v1.077c.544.193.897.25 1.073.673.177.427-.038.722-.282 1.236l.762.762c.521-.248.812-.458 1.235-.283.424.175.479.526.674 1.073h1.076c.194-.545.25-.897.676-1.074h.001c.421-.175.706.034 1.232.284l.762-.762c-.247-.521-.458-.812-.282-1.235s.529-.481 1.073-.674zm-4 .794c-.736 0-1.333-.597-1.333-1.333s.597-1.333 1.333-1.333 1.333.597 1.333 1.333-.597 1.333-1.333 1.333zm-4 3.071v-.808c-.412-.147-.673-.188-.805-.505s.024-.533.212-.927l-.572-.571c-.389.186-.607.344-.926.212s-.359-.394-.506-.805h-.807c-.146.409-.188.673-.506.805-.317.132-.533-.024-.926-.212l-.572.571c.187.393.344.609.212.927-.132.318-.396.359-.805.505v.808c.408.145.673.188.805.505.133.32-.028.542-.212.927l.572.571c.39-.186.608-.344.926-.212.318.132.359.395.506.805h.807c.146-.409.188-.673.507-.805h.001c.315-.131.529.025.924.213l.572-.571c-.186-.391-.344-.609-.212-.927s.397-.361.805-.506zm-3 .596c-.552 0-1-.447-1-1s.448-1 1-1 1 .447 1 1-.448 1-1 1z"/></svg>
                                    مدیریت سیستم
                                </a>
                            </li>
                            <li class="nav-item my-3">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                <a class="nav-link d-flex text-danger align-items-center text-bold" href="{{ route('logout') }}" onclick="event.preventDefault();
                                this.closest('form').submit();">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="ml-2 bi bi-power" viewBox="0 0 16 16">
                                        <path d="M7.5 1v7h1V1h-1z"/>
                                        <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z"/>
                                    </svg>
                                    خروج
                                </a>
                            </form>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="col-9 mt-4 pr-0">
            @yield('dashboard-contents')
        </div>

    </div>
@endsection
