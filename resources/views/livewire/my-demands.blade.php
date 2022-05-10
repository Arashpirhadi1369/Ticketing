<div class="table-responsive">

    <table class="table table-bordered  mt-2" id="myTable">
        <thead>
            <tr class="">
                <th class="">امکانات</th>
                <th>ردیف</th>
                <th>تاریخ ثبت</th>
                <th>عنوان درخواست</th>
                <th>وضعیت</th>
                <th>درخواست دهنده</th>
            </tr>
        </thead>
        <tbody>
            @foreach($myDemands as $myDemand)

            <tr class="text-sm  text-bold ">
                <td class="p-0 ">
                    <button class="btn btn-sm mt-2" data-toggle="tooltip" data-placement="bottom"
                        title="ارجاع تیکت به من">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="teal"
                            class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                        </svg>
                    </button>
                    <button class="btn btn-sm mt-2" data-placement="bottom" title="مشاهده جزئیات تیکت"
                        data-toggle="modal" data-target="#infoModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indigo"
                            class=" bi bi-info-square" viewBox="0 0 16 16">
                            <path
                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                            <path
                                d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                        </svg>
                    </button>
                    <button class="btn btn-sm mt-2 " data-toggle="tooltip" data-placement="bottom" title="حذف تیتک">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-x-circle"
                            viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </button>
                </td>
                <td>{{$loop->index + ($this->page * 10 - 9)}}</td>
                <td>{!! jdate($myDemand->created_at)->format('Y-m-d')!!}</td>
                <td>{{$myDemand->subject}}</td>
                <td>{{$myDemand->status->status}}</td>
                <td>{{$myDemand->user->name}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mr-4 ">
        {{ $myDemands->links('vendor.livewire.bootstrap') }}
    </div>
    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="teal"
                            class=" bi bi-info-square" viewBox="0 0 16 16">
                            <path
                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                            <path
                                d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                        </svg>
                        <h5 class="modal-title mx-3 text-bold" id="exampleModalLabel">اطلاعات تیکت</h5>
                        <span class="badge badge-pill badge-primary">جدید</span>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-right">
                    <form class="">
                        @csrf
                        <div class="form-group">
                            <div>
                                <label class="text-bold">ردیف تیکت :</label>
                                <label>101</label>
                            </div>
                            <div>
                                <label class="text-bold">درخواست دهنده :</label>
                                <label>مسعود قاسمی تاج</label>
                            </div>
                            <div>
                                <label class="text-bold">عنوان تیکت :</label>
                                <label> درخواست تغییر ویندوز سیستم</label>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="form-group">
                        <div>
                            <label class="text-bold">شرح تیکت :</label>
                            </br>
                            <label>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای
                                شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می
                                طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و
                                فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری
                                موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی
                                دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار
                                گیرد.

                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط
                                فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای
                                زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با
                                نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو
                                در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه
                                راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و
                                جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                            </label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">ارجاع به من</button>
                    <button type="button" class="btn btn-outline-danger">انصراف</button>
                </div>
            </div>
        </div>
    </div>


</div>