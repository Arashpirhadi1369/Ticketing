@extends('dashboardlayouts.masterdashboard')
@section('dashboard-contents')

    <div class="card border-0 bg-light  shadow " style="height: 70px;border-radius: 10px">
        <div class="card-body">

        </div>
    </div>
    <div class="card text-center bg-light mt-4 border-0 shadow " id="dashboard-content" style="    border-radius: 10px">
        <nav >
            <div class="nav nav-tabs mt-3" id="nav-tab" role="tablist">

                <a class="nav-link active" id="nav-all-request-tab" data-toggle="tab"
                   href="#nav-all-request" role="tab" aria-controls="nav-all-request" aria-selected="true">همه درخواست ها</a>


                <a class="nav-link text-warning" id="nav-inprogress-tab" data-toggle="tab"
                   href="#nav-inprogress" role="tab" aria-controls="nav-inprogress" aria-selected="false">
                    درحال انجام
                    <span class="badge badge-pill badge-warning">3</span>
                </a>


                <a class="nav-link text-success" id="nav-done-tab" data-toggle="tab"
                   href="#nav-done" role="tab" aria-controls="nav-done" aria-selected="false">
                    انجام شده
                    <span class="badge badge-pill badge-success">4</span>
                </a>

                <a class="nav-link text-danger" id="nav-reject-tab" data-toggle="tab"
                   href="#nav-reject" role="tab" aria-controls="nav-reject" aria-selected="false">
                    رد شده
                    <span class="badge badge-pill badge-danger">3</span>
                </a>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-all-request" role="tabpanel" aria-labelledby="nav-all-request-tab">
                @include('gridlayouts.gridview')
            </div>
            <div class="tab-pane fade" id="nav-inprogress" role="tabpanel" aria-labelledby="nav-inprogress-tab">
                @include('gridlayouts.gridview')
            </div>
            <div class="tab-pane fade" id="nav-done" role="tabpanel" aria-labelledby="nav-done-tab">
                @include('gridlayouts.gridview')
            </div>
            <div class="tab-pane fade" id="nav-reject" role="tabpanel" aria-labelledby="nav-reject-tab">
                @include('gridlayouts.gridview')
            </div>
        </div>
    </div>

@endsection
