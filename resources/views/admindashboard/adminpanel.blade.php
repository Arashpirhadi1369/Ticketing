@extends('dashboardlayouts.masterdashboard')
@section('dashboard-contents')

   <div class="card border-0 bg-light  shadow " style="height: 70px;border-radius: 10px">
        <div class="card-body">

        </div>
   </div>

   <div class="card text-center bg-light  mt-4 border-0 shadow " style="    border-radius: 10px">
       <div class="card-header bg-light" style="    border-radius: 10px 10px 0px 0px">
           <ul class="nav nav-tabs card-header-tabs">
               <li class="nav-item">
                   <a class="nav-link active text-dark text-bold" href="#">درخواستهای من</a>
               </li>
               <li class="nav-item ">
                   <a class="nav-link text-warning text-bold" href="#">
                       درحال انجام
                       <span class="badge badge-pill badge-warning">1</span>
                   </a>

               </li>
               <li class="nav-item">
                   <a class="nav-link text-success text-bold ">
                       انجام شده
                       <span class="badge badge-pill badge-success">3</span>
                   </a>

               </li>
               <li class="nav-item">
                   <a class="nav-link text-danger text-bold">
                       رد شده
                       <span class="badge badge-pill badge-danger">2</span>
                   </a>
               </li>
           </ul>
       </div>
       <div class="card-body">
            @yield('data-content')
       </div>
   </div>

@endsection
