<div wire:ignore.self class="modal fade" id="infoModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabelCompanies" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabelCompanies">افزودن</h5>
                <button wire:click.prevent="resetInput" type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <div class="form-group">

                        <div class="form-group d-flex justify-content-between col-md-8 p-0 text-center">
                            <div class="">
                                <label class="text-bold"> نام دریافت کننده :</label>
                                <label>{{$this->entity->receiver_name}}</label>
                            </div>
                            <div class="">
                                <label class="text-bold"> شماره دریافت کننده :</label>
                                <label>{{$this->entity->destination_number}}</label>
                            </div>
                            <div class="">
                                <label class="text-bold">ارسال کننده:</label>
                                @if ($this->entity->senderUser)
                                <label>{{$this->entity->senderUser->name}}</label>
                                @endif
                            </div>
                            <div class="">
                                <label class="text-bold"> هزینه ارسال :</label>
                                <label>{{$this->entity->cost}}</label>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group ">
                            <div>
                                <label class="text-bold">متن پیامک :</label>
                                </br>
                                <label class="text-bold">{{$this->entity->message}}</label>
                            </div>
                        </div>

                        <div class="mt-4 modal-footer">

                            <button wire:click="resetInput" class="btn btn-secondary mt-2" data-dismiss="modal">انصراف
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>