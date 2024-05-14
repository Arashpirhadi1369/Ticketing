<div wire:ignore.self class="modal fade" id="createAnswerModal" data-backdrop="static" data-keyboard="false"
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

                        @if (count($this->entity->answers) == 0)
                        @foreach ($this->answers as $key => $value)
                        <label class="mr-2" for="answer">{{__('answer').$key+1}}</label>
                        <input wire:model.debounce.500ms="answers.{{$key}}" class="form-control  mb-2">
                        @endforeach

                        @else
                        @foreach ($this->effectivenessQuestionAnswer as $key => $value)
                        {{-- @dd($this->effectivenessQuestionAnswer) --}}
                        <div>
                            <label class="mr-2"
                                for="effectivenessQuestionAnswer.{{$key}}.answer">{{__('answer').$key+1}}</label>
                            @error("effectivenessQuestionAnswer.{{$key}}.answer")<span class="mr-2  text-danger">{{
                                $message
                                }}</span>@enderror
                        </div>

                        <input wire:model.debounce.500ms="effectivenessQuestionAnswer.{{$key}}.answer"
                            class="form-control  mb-2" name="effectivenessQuestionAnswer.{{$key}}.answer"
                            id="effectivenessQuestionAnswer.{{$key}}.answer">
                        @endforeach

                        @endif

                        <div class="mt-4 modal-footer">
                            <button wire:click.prevent="storeAnswers" type="submit" class="btn btn-info mt-2">ذخیره
                            </button>
                            {{-- <button wire:click="resetInput" id="dashboardModalClose" class="btn btn-secondary mt-2"
                                data-dismiss="modal">انصراف
                            </button> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>