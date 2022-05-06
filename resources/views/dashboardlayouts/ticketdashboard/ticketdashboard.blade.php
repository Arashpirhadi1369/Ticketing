@extends('dashboardlayouts.masterdashboard')
@section('dashboard-contents')

    <div class="card border-0 bg-light  shadow " style="height: 70px;border-radius: 10px">
        <div class="card-body">

        </div>
    </div>
    <div class="card text-center bg-light mt-4 border-0 shadow " id="dashboard-content" style="border-radius: 10px">
        <nav class="d-flex flex-row d-flex justify-content-between align-items-center">
            <div class="nav nav-tabs mt-3" id="nav-tab" role="tablist">
                @if(isAdmin())
                <a class="nav-link active" id="nav-all-demand-tab" data-toggle="tab"
                   href="#nav-all-demand" role="tab" aria-controls="nav-all-demand" aria-selected="true">
                    همه درخواست ها
                    <span class="badge badge-pill badge-primary">50</span>
                </a>
                    <a class="nav-link text-info" id="nav-my-demand-tab" data-toggle="tab"
                       href="#nav-my-demand" role="tab" aria-controls="nav-my-demand" aria-selected="true">
                        تیکت های من
                        <span class="badge badge-pill badge-info">3</span>
                    </a>
                @else
                    <a class="nav-link text-info" id="nav-my-demand-tab" data-toggle="tab"
                       href="#nav-my-demand" role="tab" aria-controls="nav-my-demand" aria-selected="true">
                        درخواست های من
                        <span class="badge badge-pill badge-info">3</span>
                    </a>
                @endif

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
                    <button class="btn btn-info " data-toggle="modal" data-target="#newticketModal">ثبت درخواست جدید
                    </button>
                </div>
                <div class="form-group d-flex flex-column">
                    <div class="form-control bg-light input-group search-input my-2 ">
                        <div class="input-group-prepend ">
                            <span class=" input-group-text bg-white border-left-0 pr-3" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                     class="bi bi-search" viewBox="0 0 16 16">
                                  <path
                                      d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </span>
                        </div>
                        <input  type="text" class="form-control text-bold search-input border border-right-0"
                               name="search" id="search-input" onkeyup="myFunction()"  placeholder="جستجو">
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
            <div class="tab-pane fade" id="nav-demand-inprogress" role="tabpanel"
                 aria-labelledby="nav-demand-inprogress-tab">
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
    <!-- Modal -->
    <div class="modal fade" id="newticketModal" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="teal"
                             class="bi bi-plus-square" viewBox="0 0 16 16">
                            <path
                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        <h5 class="modal-title mx-3 text-bold" id="exampleModalLabel">ثبت درخواست جدید</h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-right">
                    <form class="">
                        @csrf
                        <div class="form-group">
                            <label>عنوان درخواست</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="" for="inlineFormCustomSelectPref">نوع درخواست</label>
                            <select class="custom-select" id="inlineFormCustomSelectPref">
                                <option selected>انتخاب کنید...</option>
                                <option value="1">سخت افزاری</option>
                                <option value="2">نرم افزاری</option>
                                <option value="3">سامانه ها</option>
                            </select>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label>شرح درخواست</label>
                            <textarea class="form-control" rows="7"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">ثبت درخواست</button>
                    <button type="button" class="btn btn-outline-danger ">انصراف</button>
                </div>
            </div>
        </div>
        <script>
            function myFunction() {
                let input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("search-input");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        </script>
@endsection


