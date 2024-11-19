<div wire:ignore.self class="modal fade" id="createQuestionModal" data-backdrop="static" data-keyboard="false"
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
                <form onkeydown="return event.key != 'Enter';">
                    @csrf
                    <div class="form-group">

                        @if (count($this->entity->questions) == 0)
                        @foreach ($this->questions as $key => $value)
                        <label class="mr-2" for="question">{{__('question').$key+1}}</label>
                        <input wire:model.debounce.500ms="questions.{{$key}}" class="form-control  mb-2">
                        @endforeach

                        @else
                        @foreach ($this->effectivenessQuestion as $key => $value)
                        <div>
                            <label class="mr-2"
                                for="effectivenessQuestion.{{$key}}.question">{{__('question').$key+1}}</label>
                            @error("effectivenessQuestion.{{$key}}.question")<span class="mr-2  text-danger">{{
                                $message
                                }}</span>@enderror
                        </div>

                        <input wire:model.debounce.500ms="effectivenessQuestion.{{$key}}.question"
                            class="form-control  mb-2" name="effectivenessQuestion.{{$key}}.question"
                            id="effectivenessQuestion.{{$key}}.question">
                        @endforeach

                        @endif

                        <div class="mt-4 modal-footer">
                            <button wire:click.prevent="storeQuestions" type="submit" class="btn btn-info mt-2">ذخیره
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