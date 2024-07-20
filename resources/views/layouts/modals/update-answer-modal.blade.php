<div wire:ignore.self class="modal fade" id="updateAnswerModal" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabelCompanies" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabelCompanies">افزودن</h5>
                <button wire:click="resetInput" type="button" class="close" data-dismiss="modal" aria-label="Close"
                    id="smsModalClose">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <div class="form-group">


                        <div>
                            <label class="mr-2" for="userAnswers"></label>
                            @error("userAnswers")<span class="mr-2  text-danger">{{
                                $message
                                }}</span>@enderror
                        </div>
                        @isset($this->questions)
                        @foreach ($this->questions as $key =>$value)

                        <div class="mb-2"><span>{{$value->question}}</span></div>

                        <div wire:ignore class="mb-2">
                            <select wire:model.debounce.500ms="userAnswers.{{$key}}" class="custom-select form-control"
                                name="userAnswers.{{$key}}" id="userAnswers.{{$key}}">
                                <option selected>جواب را انتخاب کنید ...</option>
                                @foreach($value->answers as $answer)
                                <option value="{{$answer->id}}">{{__($answer->answer)}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @endforeach
                        @endisset

                        <div class="mt-4 modal-footer">
                            <button wire:click.prevent="store" type="submit" class="btn btn-info mt-2">ذخیره
                            </button>
                            <button wire:click="resetInput" id="dashboardModalClose" class="btn btn-secondary mt-2"
                                data-dismiss="modal">انصراف
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>