<div wire:ignore.self class="modal fade" id="createModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabelCompanies" aria-hidden="true">
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

                        @foreach ($modalFields as $field)
                        <div>
                            <label class="mr-2" for="{{$field}}">{{__($field)}}</label>
                            @error("entity.$field")<span class="mr-2  text-danger">{{ $message
                                }}</span>@enderror
                        </div>
                        <input wire:model.debounce.500ms="entity.{{$field}}" class="form-control mb-2" name="{{$field}}"
                            id="{{$field}}">
                        @endforeach

                        <div class="mt-4 modal-footer">
                            <button wire:click.prevent="store" type="submit" class="btn btn-info mt-2">ذخیره
                            </button>
                            <button wire:click="resetInput" class="btn btn-secondary mt-2" data-dismiss="modal">انصراف
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>