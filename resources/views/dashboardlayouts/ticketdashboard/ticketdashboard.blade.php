@extends('dashboardlayouts.masterdashboard')
@section('dashboard-contents')

    <div class="card border-0 bg-light  shadow " style="height: 70px;border-radius: 10px">
        <div class="card-body">

        </div>
    </div>
    <div class="card text-center bg-light mt-4 border-0 shadow " id="dashboard-content" style="border-radius: 10px">
        <nav class="d-flex flex-row d-flex justify-content-between align-items-center">
            <div class="nav nav-tabs mt-3" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-all-demand-tab" data-toggle="tab"
                   href="#nav-all-demand" role="tab" aria-controls="nav-all-demand" aria-selected="true">
                    همه درخواست ها
                    <span class="badge badge-pill badge-primary">50</span>
                </a>

                <a class="nav-link text-info" id="nav-my-demand-tab" data-toggle="tab"
                   href="#nav-my-demand" role="tab" aria-controls="nav-my-demand" aria-selected="true">
                    درخواست های من
                    <span class="badge badge-pill badge-info">3</span>
                </a>

                <a class="nav-link text-warning" id="nav-demand-inprogress-tab" data-toggle="tab"
                   href="#nav-demand-inprogress" role="tab" aria-controls="nav-demand-inprogress" aria-selected="false">
                    درحال انجام
                    <span class="badge badge-pill badge-warning">3</span>
                </a>

                <a class="nav-link text-success" id="nav-demand-done-tab" data-toggle="tab"
                   href="#nav-demand-done" role="tab" aria-controls="nav-demand-done" aria-selected="false">
                    انجام شده
                    <span class="badge badge-pill badge-success">4</span>
                </a>

                <a class="nav-link text-danger" id="nav-demand-reject-tab" data-toggle="tab"
                   href="#nav-demand-reject" role="tab" aria-controls="nav-demand-reject" aria-selected="false">
                    رد شده
                    <span class="badge badge-pill badge-danger">3</span>
                </a>

            </div>
            <div class="d-flex align-items-center">
                <div class="my-2">
                    <button class="btn btn-info ">ثبت درخواست جدید</button>
                </div>
                <div class="form-group d-flex flex-column">
                    <div class="form-control bg-light input-group search-input my-2 ">
                        <div class="input-group-prepend ">
                            <span class=" input-group-text bg-white border-left-0 pr-3" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </span>
                        </div>
                        <input type="text" class="form-control text-bold search-input border border-right-0" name="username" id="username" placeholder="جستجو">
                    </div>
                </div>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-all-demand" role="tabpanel"
                 aria-labelledby="nav-all-demand-tab">
                @include('dashboardlayouts.demandtypelayouts.alldemand')
            </div>
            <div class="tab-pane fade  " id="nav-my-demand" role="tabpanel" aria-labelledby="nav-my-demand-tab">
                @include('dashboardlayouts.demandtypelayouts.mydemand')
            </div>
            <div class="tab-pane fade" id="nav-demand-inprogress" role="tabpanel" aria-labelledby="nav-demand-inprogress-tab">
                @include('dashboardlayouts.demandtypelayouts.inprogressdemand')
            </div>
            <div class="tab-pane fade" id="nav-demand-done" role="tabpanel" aria-labelledby="nav-demand-done-tab">
                @include('dashboardlayouts.demandtypelayouts.donedemand')
            </div>
            <div class="tab-pane fade" id="nav-demand-reject" role="tabpanel" aria-labelledby="nav-demand-reject-tab">
                @include('dashboardlayouts.demandtypelayouts.rejectdemand')
            </div>
        </div>
    </div>

@endsection
