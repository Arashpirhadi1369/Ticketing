<div>
    <div class="d-flex ">
        <div class="col-3 my-4" id="navbar-dashboard">
            <div class=" bg-light shadow  mr-2" id="navbar-dashboard">
                <div class="mx-4 pt-4 d-flex flex-row align-items-center">
                    <a class="d-flex flex-row align-items-center text-decoration-none text-dark">
                        <img class="" src="{{url('images/logo.png')}}" style="width: 4rem ; height: 2rem">
                        <div class="mr-2 mt-2">
                            <h5 class="text-demibold company-text">شرکت محافظان بهبود آب</h5>
                            <h6 class="text-small company-text">MBA Water Treatment Chemicals</h6>
                        </div>
                    </a>
                </div>
                <div class="dropdown-divider mt-4"></div>
                <nav class="navbar navbar-expand-lg">
                    <div class="dropdown-divider"></div>

                    <div class="collapse navbar-collapse align-self-start mt-5 " id="navbarSupportedContent">
                        <ul class="navbar-nav d-flex flex-column">
                            <li class="nav-item">
                                <a class="nav-link d-flex text-dark align-items-center mt-3 " data-toggle="collapse"
                                    href="{{ route('dashboard') }}" role="button" aria-expanded="true"
                                    aria-controls="collapseExample">
                                    <svg width="25" height="25" fill="balck" class="ml-3 bi"
                                        xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                                        <path
                                            d="M20 24h-20v-22h3c1.229 0 2.18-1.084 3-2h8c.82.916 1.771 2 3 2h3v9h-2v-7h-4l-2 2h-3.898l-2.102-2h-4v18h16v-5h2v7zm-10-4h-6v-1h6v1zm0-2h-6v-1h6v1zm6-5h8v2h-8v3l-5-4 5-4v3zm-6 3h-6v-1h6v1zm0-2h-6v-1h6v1zm0-2h-6v-1h6v1zm0-2h-6v-1h6v1zm-1-7c0 .552.448 1 1 1s1-.448 1-1-.448-1-1-1-1 .448-1 1z" />
                                    </svg>
                                    داشبورد
                                </a>
                                <div class="collapse" id="collapseExample">

                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex text-dark align-items-center mt-3 " href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="black"
                                        class="ml-3 bi bi-person-lines-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                                    </svg>
                                    ارسال SMS
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex text-dark align-items-center mt-3 " href="/entities">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="balck"
                                        class="ml-3 bi" viewBox="0 0 24 24">
                                        <path
                                            d="M17 10.645v-2.29c-1.17-.417-1.907-.533-2.28-1.431-.373-.9.07-1.512.6-2.625l-1.618-1.619c-1.105.525-1.723.974-2.626.6-.9-.373-1.017-1.116-1.431-2.28h-2.29c-.412 1.158-.53 1.907-1.431 2.28h-.001c-.9.374-1.51-.07-2.625-.6l-1.617 1.619c.527 1.11.973 1.724.6 2.625-.375.901-1.123 1.019-2.281 1.431v2.289c1.155.412 1.907.531 2.28 1.431.376.908-.081 1.534-.6 2.625l1.618 1.619c1.107-.525 1.724-.974 2.625-.6h.001c.9.373 1.018 1.118 1.431 2.28h2.289c.412-1.158.53-1.905 1.437-2.282h.001c.894-.372 1.501.071 2.619.602l1.618-1.619c-.525-1.107-.974-1.723-.601-2.625.374-.899 1.126-1.019 2.282-1.43zm-8.5 1.689c-1.564 0-2.833-1.269-2.833-2.834s1.269-2.834 2.833-2.834 2.833 1.269 2.833 2.834-1.269 2.834-2.833 2.834zm15.5 4.205v-1.077c-.55-.196-.897-.251-1.073-.673-.176-.424.033-.711.282-1.236l-.762-.762c-.52.248-.811.458-1.235.283-.424-.175-.479-.525-.674-1.073h-1.076c-.194.545-.25.897-.674 1.073-.424.176-.711-.033-1.235-.283l-.762.762c.248.523.458.812.282 1.236-.176.424-.528.479-1.073.673v1.077c.544.193.897.25 1.073.673.177.427-.038.722-.282 1.236l.762.762c.521-.248.812-.458 1.235-.283.424.175.479.526.674 1.073h1.076c.194-.545.25-.897.676-1.074h.001c.421-.175.706.034 1.232.284l.762-.762c-.247-.521-.458-.812-.282-1.235s.529-.481 1.073-.674zm-4 .794c-.736 0-1.333-.597-1.333-1.333s.597-1.333 1.333-1.333 1.333.597 1.333 1.333-.597 1.333-1.333 1.333zm-4 3.071v-.808c-.412-.147-.673-.188-.805-.505s.024-.533.212-.927l-.572-.571c-.389.186-.607.344-.926.212s-.359-.394-.506-.805h-.807c-.146.409-.188.673-.506.805-.317.132-.533-.024-.926-.212l-.572.571c.187.393.344.609.212.927-.132.318-.396.359-.805.505v.808c.408.145.673.188.805.505.133.32-.028.542-.212.927l.572.571c.39-.186.608-.344.926-.212.318.132.359.395.506.805h.807c.146-.409.188-.673.507-.805h.001c.315-.131.529.025.924.213l.572-.571c-.186-.391-.344-.609-.212-.927s.397-.361.805-.506zm-3 .596c-.552 0-1-.447-1-1s.448-1 1-1 1 .447 1 1-.448 1-1 1z" />
                                    </svg>
                                    مدیریت کاربران
                                </a>
                            </li>
                            <li class="nav-item my-3">

                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="col-9 mt-4 pr-0">
            <div class="card border-0 bg-light shadow " style="height: 70px;border-radius: 10px">
                <div class="card-body d-flex flex-row py-3 justify-content-between align-items-center">
                    {{-- <button wire:click="$set('showSavedButton' , 1)" type="button"
                        class="btn btn-success d-flex flex-row" data-toggle="modal" data-target="#test">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="ml-2 bi bi-plus-square" viewBox="0 0 16 16">
                            <path
                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z">
                            </path>
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                            </path>
                        </svg>
                        ثبت درخواست جدید
                    </button> --}}

                    <div wire:ignore.self class="modal fade" id="deletemodal" data-backdrop="static"
                        data-keyboard="false" tabindex="-1" aria-labelledby="deletemodal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">حذف اطلاعات {{ __($this->componentName) }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="h6 ">آیا از حذف اطلاعات <span class="h6 text-danger">{{ $entity->name
                                            }}</span> مطمئن هستید ؟
                                    </p>
                                    <div class="mt-4 modal-footer">
                                        <button wire:click="destroy" class="btn btn-outline-danger mt-2"
                                            data-dismiss="modal">بله ،
                                            اطلاعات حذف شود
                                        </button>
                                        <button wire:click='resetInput' class="btn btn-secondary mt-2"
                                            data-dismiss="modal">انصراف
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Create user Modal--}}
                    <div wire:ignore.self class="modal fade" id="modal" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content" style="background-color: #f4f5f7">
                                <div class="modal-header mx-4 mt-3">
                                    <div class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green"
                                            class="ml-2 bi bi-plus-square" viewBox="0 0 16 16">
                                            <path
                                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z">
                                            </path>
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                                            </path>
                                        </svg>
                                        <h5 class="modal-title mx-3 text-bold">ثبت درخواست جدید FR035
                                        </h5>
                                    </div>
                                    <button wire:click='resetInput' type="button" class="close" data-dismiss="modal"
                                        aria-label="Close" id="dashboardModalClose">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-right">
                                    <form method="POST" class="m-4">
                                        @csrf
                                        <div class="form-group col-md-8 p-0">
                                            <label class="text-bold"> نام کاربر :</label>
                                            @error('user.name') <span class="mr-2 text-danger">{{ $message
                                                }}</span>@enderror
                                            <input wire:model.debounce.500ms='entity.name' class="form-control">
                                        </div>
                                        <hr>
                                        <div class="form-group col-md-8 p-0">
                                            <div>
                                                <label class="text-bold">شماره موبایل
                                                    :</label>
                                                @error('user.phone') <span class="mr-2 text-danger">{{ $message
                                                    }}</span>@enderror
                                                </br>
                                                <input wire:model.debounce.500ms='entity.phone' class="form-control"
                                                    name="phone" id="phone">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <div>
                                        <form>

                                        </form>
                                    </div>
                                    <div>
                                        <button wire:click='store' type="button" class="btn btn-success">ذخیره</button>
                                        <button wire:click='resetInput' type="button" data-dismiss="modal"
                                            class="btn btn-outline-danger">انصراف</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row">
                        <div class="mr-3 row">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                class=" ml-2 bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg>
                            <p class="m-0">نام کاربری : {{auth()->user()->username}}</p>
                        </div>
                        <div class="mx-4 row">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                class="ml-2 mr-4 bi bi-diagram-3-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5v-1zm-6 8A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5v-1zm6 0A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5v-1zm6 0a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1z" />
                            </svg>
                            <p class="m-0">واحد : {{auth()->user()->ou}}</p>
                        </div>
                        <div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="nav-link d-flex text-danger align-items-center text-bold p-0"
                                    href="{{ route('logout') }}" onclick="event.preventDefault();
                        this.closest('form').submit();">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red"
                                        class="bi bi-power hover:text-gray-700" viewBox="0 0 16 16">
                                        <path d="M7.5 1v7h1V1h-1z" />
                                        <path
                                            d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z" />
                                    </svg>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4 rounded rounded-lg">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between align-items-center">

                        <p class="h5 mb-0">اطلاعات کاریران</p>

                        <div class="d-flex flex-row align-items-center">

                            <div class="dropdown">
                                <a class="btn btn-outline-info dropdown-toggle" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                        class="bi bi-menu-button-wide ml-2" viewBox="0 0 16 16">
                                        <path
                                            d="M0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v2A1.5 1.5 0 0 1 14.5 5h-13A1.5 1.5 0 0 1 0 3.5v-2zM1.5 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-13z" />
                                        <path
                                            d="M2 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm10.823.323-.396-.396A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2H1zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2h14zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                    امکانات بیشتر
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    <button wire:click="exportSelected" class="dropdown-item text-success text-small">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green"
                                            class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                                            <path d="M6 12v-2h3v2H6z" />
                                            <path
                                                d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3V9z" />
                                        </svg>
                                        خروجی اکسل
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex flex-row mr-2">
                                <div class="form-group  list-group-item list-group-item-action mb-0 p-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            @foreach ($filters as $key => $value)
                                            @if ($value != null)
                                            <a wire:click="resetFilters"
                                                class="input-group-text bg-transparent py-0 px-3 border-0 border-left-0 text-muted pointer ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path
                                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                </svg>
                                            </a>
                                            @break
                                            @endif
                                            @if ($loop->iteration == count($filters))
                                            <span
                                                class="input-group-text bg-transparent py-0 px-3 border-0 border-left-0 text-muted ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                                </svg>
                                            </span>
                                            @endif
                                            @endforeach
                                        </div>
                                        <input wire:model.debounce.500ms="filters.{{ $filter }}"
                                            class="form-control bg-transparent border-0 text-right focus:shadow-nones"
                                            autofocus id="filter-search" type="text" placeholder="جستجو ...">
                                        <div class="input-group-prepend arrow">
                                            <div class="dropdown">
                                                <span
                                                    class="btn input-group-text bg-transparent mt-2 px-2 border-0 dropdown-toggle"
                                                    role="button" id="dropdownMenuLink" data-toggle="dropdown">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-three-dots-vertical"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                    </svg>
                                                </span>
                                                <div class="dropdown-menu dropdown-menu-left"
                                                    aria-labelledby="dropdownMenuLink">
                                                    @foreach ($filters as $key => $value)
                                                    <button wire:click="$set('filter' , '{{$key}}')"
                                                        class="dropdown-item">
                                                        {{__($key)}}
                                                    </button>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table id="table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr class="text-center">

                                <th>
                                    <div>
                                        <span>#</span>
                                    </div>
                                </th>

                                @if ($entities->isNotEmpty())
                                <th style="width: 13%">
                                    <div class="d-flex flex-row">
                                        <input wire:model="selectPage" class="mt-2 mycheckbox" type="checkbox" />
                                        <span class="mr-4 mt-1">عملیات</span>
                                    </div>
                                </th>
                                @endif

                                @foreach ($headers as $header)
                                @if ($header == 'id' || $header == 'created_at' || $header == 'updated_at' ||
                                $header == 'msds' || $header == 'coa')
                                @continue
                                @endif
                                <th>
                                    <span wire:click="sortby('{{$header}}')" class="pointer">{{__($header)}}</span>
                                    @if ($sortDirection == 'asc' && $sortField == '{{__($header)}}')
                                    <span wire:click="sortby('{{__($header)}}')" class="pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                            fill="currentColor" class="bi bi-caret-up" viewBox="0 0 16 16">
                                            <path
                                                d="M3.204 11h9.592L8 5.519 3.204 11zm-.753-.659 4.796-5.48a1 1 0 0 1 1.506 0l4.796 5.48c.566.647.106 1.659-.753 1.659H3.204a1 1 0 0 1-.753-1.659z" />
                                        </svg>
                                    </span>
                                    @elseif($sortDirection == 'desc' && $sortField == '{{__($header)}}')
                                    <span wire:click="sortby('{{__($header)}}')" class="pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                            fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                                            <path
                                                d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
                                        </svg>
                                    </span>
                                    @endif
                                </th>

                                @endforeach
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($entities as $entity)
                            <tr class="text-center">

                                <td>
                                    <div>
                                        <span>{{$loop->index + ($this->page * 10 - 9)}}</span>
                                    </div>
                                </td>

                                <td>
                                    <div>
                                        <input wire:model="selected" type="checkbox" class="mycheckbox"
                                            value="{{ $entity->id }}" />

                                        <button wire:click="edit({{ $entity->id }})"
                                            class="btn text-info bg-transparent border-0" type="button"
                                            data-toggle="modal" data-target="#modal">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </button>

                                        <button wire:click="edit({{ $entity->id }})"
                                            class="btn bg-transparent text-danger border-0" type="button"
                                            data-toggle="modal" data-target="#deletemodal">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd"
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>

                                @foreach ($headers as $header)

                                @if ($header == 'id' || $header == 'created_at' || $header == 'updated_at' ||
                                $header == 'msds' || $header == 'coa')
                                @continue
                                @endif

                                <td> {{$entity["$header"]}} </td>

                                @endforeach
                            </tr>
                            @empty
                            <td colspan="{{count($headers)}}" class="h5 text-center text-danger pt-4 pb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-exclamation-triangle ml-2" viewBox="0 0 16 16">
                                    <path
                                        d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                                    <path
                                        d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
                                </svg>
                                نتیجه ای یافت نشد
                            </td>
                            @endforelse
                        </tbody>

                    </table>
                </div>
                <div
                    class="card-footer thead-light shadow-sm  text-muted d-flex flex-row justify-content-between align-items-center">
                    <div class="d-flex flex-row">

                        @foreach ($filters as $key => $value)
                        @if ($value != null)
                        <p class="ml-3 mt-3">فیلترهای جستجو شما بر اساس : </p>
                        @break
                        @endif
                        @if ($loop->iteration == count($filters))
                        <small>نمایش اطلاعات کاربران</small>
                        @endif
                        @endforeach

                        @foreach ($filters as $key => $value)
                        @if ($value != null)
                        <div class="d-flex flex-row mt-3">
                            <p>({{__($key)}} :
                            <p class="text-danger text-bold mr-1 ">{{ $value }}</p>) , </p>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="mt-2">{{ $entities->links() }}</div>
            </div>
        </div>
    </div>
</div>