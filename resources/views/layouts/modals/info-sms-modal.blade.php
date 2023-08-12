<div wire:ignore.self class="modal  fade" id="infoModal" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabelCompanies" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content p-3 ">
            <div class="modal-header">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi text-bold ml-2 bi-send" viewBox="0 0 16 16">
                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                    </svg>
                    <h5 class="modal-title text-bold" id="staticBackdropLabelCompanies"> جزئیات پیام</h5>
                </div>
                <button wire:click.prevent="resetInput" type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div wire:click.prevent="resetInput" class="modal-body">
                    @csrf
                    <div class="form-group">
                        <div class=" p-0">
                            <div class="">
                                <label class="text-bold"> نام دریافت کننده :</label>
                                <label>{{$this->infoEntity->receiver_name}}</label>
                            </div>
                            <div class="">
                                <label class="text-bold"> شماره دریافت کننده :</label>
                                <label>{{$this->infoEntity->destination_number}}</label>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="">
                                    <label class="text-bold">ارسال کننده:</label>
                                    @if ($this->infoEntity->senderUser)
                                        <label>{{$this->infoEntity->senderUser->name}}</label>
                                    @endif
                                </div>
                                <div class="">
                                    <label class="text-bold"> هزینه ارسال :</label>
                                    <label>{{$this->infoEntity->cost}}</label>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="">
                            <label class="text-bold">متن پیامک :</label>
                            <p class="text-break text-justify">{{$this->infoEntity->message}}</p>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
