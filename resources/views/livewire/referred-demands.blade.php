<div class="col-3  px-0">
    <!-- Referred Demand  -->
    <div class="card overflow-auto px-2   bg-light ticket-container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="card-header bg-light text-warning border-0">
                درخواست های من
                <span class="badge badge-pill badge-warning">{{$referredDemands->count()}}</span>
            </div>
            <div class="">
                <button wire:click="exportExcel" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="green"
                        class="bi bi-filetype-xlsx" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM7.86 14.841a1.13 1.13 0 0 0 .401.823c.13.108.29.192.479.252.19.061.411.091.665.091.338 0 .624-.053.858-.158.237-.105.416-.252.54-.44a1.17 1.17 0 0 0 .187-.656c0-.224-.045-.41-.135-.56a1.002 1.002 0 0 0-.375-.357 2.028 2.028 0 0 0-.565-.21l-.621-.144a.97.97 0 0 1-.405-.176.37.37 0 0 1-.143-.299c0-.156.061-.284.184-.384.125-.101.296-.152.513-.152.143 0 .266.023.37.068a.624.624 0 0 1 .245.181.56.56 0 0 1 .12.258h.75a1.093 1.093 0 0 0-.199-.566 1.21 1.21 0 0 0-.5-.41 1.813 1.813 0 0 0-.78-.152c-.293 0-.552.05-.777.15-.224.099-.4.24-.527.421-.127.182-.19.395-.19.639 0 .201.04.376.123.524.082.149.199.27.351.367.153.095.332.167.54.213l.618.144c.207.049.36.113.462.193a.387.387 0 0 1 .153.326.512.512 0 0 1-.085.29.558.558 0 0 1-.255.193c-.111.047-.25.07-.413.07-.117 0-.224-.013-.32-.04a.837.837 0 0 1-.249-.115.578.578 0 0 1-.255-.384h-.764Zm-3.726-2.909h.893l-1.274 2.007 1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415H1.5l1.24-2.016-1.228-1.983h.931l.832 1.438h.036l.823-1.438Zm1.923 3.325h1.697v.674H5.266v-3.999h.791v3.325Zm7.636-3.325h.893l-1.274 2.007 1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415h-.861l1.24-2.016-1.228-1.983h.931l.832 1.438h.036l.823-1.438Z" />
                    </svg>
                </button>
            </div>
        </div>

        @if ($referredDemands->isNotEmpty())

        <div class="card-body p-0">
            @foreach($referredDemands as $referredDemand)
            <div class="card list-group-item-action  border-0 mb-2 shadow">
                <div wire:click="edit({{ $referredDemand }})" data-toggle="modal" data-target="#referred-demand"
                    class=" card-body px-2 py-2">
                    <div class="mt-1 p-0 btn">
                        <p class="text-small text-bold mb-0 text-right">{{$referredDemand->id}} -
                            {{$referredDemand->subject}}</p>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="p-0 btn">
                            <span class="badge badge-pill badge-dark">{{__($referredDemand->user->name)}}</span>
                            <span class="badge badge-pill badge-warning">{{__($referredDemand->status->status)}}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>



    <!-- Referred Demand  Modal -->
    <div wire:ignore.self class="modal fade" id="referred-demand" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content" style="background-color: #f4f5f7">
                <div class="modal-header mx-4 mt-3">
                    <div class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="orange"
                            class="bi bi-wrench-adjustable-circle" viewBox="0 0 16 16">
                            <path
                                d="M12.496 8a4.491 4.491 0 0 1-1.703 3.526L9.497 8.5l2.959-1.11c.027.2.04.403.04.61Z" />
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-1 0a7 7 0 1 0-13.202 3.249l1.988-1.657a4.5 4.5 0 0 1 7.537-4.623L7.497 6.5l1 2.5 1.333 3.11c-.56.251-1.18.39-1.833.39a4.49 4.49 0 0 1-1.592-.29L4.747 14.2A7 7 0 0 0 15 8Zm-8.295.139a.25.25 0 0 0-.288-.376l-1.5.5.159.474.808-.27-.595.894a.25.25 0 0 0 .287.376l.808-.27-.595.894a.25.25 0 0 0 .287.376l1.5-.5-.159-.474-.808.27.596-.894a.25.25 0 0 0-.288-.376l-.808.27.596-.894Z" />
                        </svg>
                        <h5 class="modal-title mx-3 text-bold">اطلاعات درخواست</h5>

                        @foreach ($ticketStatuses as $status)
                        @if ($status->id == $ticket->status_id)
                        <span class="badge badge-pill badge-warning">{{__($status->status)}}</span>
                        @endif
                        @endforeach

                    </div>
                    <button wire:click='resetInput' type="button" class="close" data-dismiss="modal" aria-label="Close"
                        id="referredModalClose">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-right">
                    <form class="m-4">
                        @csrf
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <label class="text-bold">کد درخواست :</label>
                                    <label>{{$ticket->id}}</label>
                                </div>
                                <div class="d-flex">
                                    <div>
                                        <label class="text-bold">تاریخ ثبت :</label>
                                        <label>{!!
                                            jdate($ticket->created_at)->format('Y-m-d')!!}</label>
                                    </div>
                                    <div class="mr-3">
                                        <label class="text-bold">تاریخ ارجاع :</label>
                                        <label>{!!
                                            jdate($ticket->updated_at)->format('Y-m-d')!!}</label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="text-bold">درخواست دهنده :</label>

                                @foreach ($users as $user)
                                @if ($user->id == $ticket->user_id)
                                <label>{{__($user->name)}}</label>
                                @endif
                                @endforeach

                            </div>
                            <div>
                                <label class="text-bold">عنوان درخواست :</label>
                                <label>{{$ticket->subject}}</label>
                            </div>
                            <hr>
                            <div class="row mr-8">
                                <div class="form-group ">
                                    <label class="text-bold" for="inputState">وضعیت درخواست</label>
                                    <div>
                                        @error('ticket.status_id') <span class="mr-2 text-danger">{{ $message
                                            }}</span>@enderror
                                    </div>
                                    <select wire:model.debounce.500ms="ticket.status_id"
                                        class="custom-select form-control" name="status_id" id="status_id">
                                        <option selected>وضعیت درخواست را انتخاب کنید ...</option>
                                        @foreach($ticketStatuses as $ticketStatus)
                                        <option value="{{$ticketStatus->id}}">{{__($ticketStatus->status)}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>&nbsp;
                                <div class="form-group ">
                                    <label class="text-bold" for="inputState">نوع درخواست</label>
                                    <div>
                                        @error('ticket.type_id') <span class="mr-2 text-danger">{{ $message
                                            }}</span>@enderror
                                    </div>
                                    <select wire:model.debounce.500ms="ticket.type_id"
                                        class="custom-select form-control" name="type_id" id="type_id">
                                        <option selected>نوع درخواست را انتخاب کنید ...</option>
                                        @foreach($ticketTypes as $ticketType)
                                        <option value="{{$ticketType->id}}">{{__($ticketType->type)}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="form-group m-4">
                        <div>
                            <label class="text-bold">شرح درخواست :</label>
                            </br>
                            <label>{{$ticket->content}}</label>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group m-3">
                        <div class="">
                            <label class="text-bold">پاسخ به درخواست :</label>
                            <div>
                                @error('ticket.reply') <span class="mr-2 text-danger">{{ $message
                                    }}</span>@enderror
                            </div>
                            </br>
                            <textarea wire:model.debounce.500ms="ticket.reply" class="d-inline-block form-control"
                                rows="4" name="reply" id="reply"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer m-3 ">
                    <div class="m-3">
                        <button wire:click='update' type="button" class="btn btn-success">ارسال
                            پاسخ</button>

                        <button wire:click='resetInput' type="button" data-dismiss="modal"
                            class="btn btn-outline-danger">انصراف</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>