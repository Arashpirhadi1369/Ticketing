<div wire:ignore.self class="modal fade" id="createCourseModal" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabelCompanies" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabelCompanies">افزودن</h5>
                <button wire:click="resetInput" type="button" class="close" data-dismiss="modal" aria-label="Close"
                    id="courseModalClose">
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

                        @if($field == 'category_id')
                        <div wire:ignore class="mb-2">
                            <select wire:model.debounce.500ms="entity.category_id" class="custom-select form-control"
                                name="category_id" id="category_id">
                                <option selected>دسته بندی را انتخاب کنید ...</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{__($category->name)}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        @elseif($field == 'survey_id')
                        <div wire:ignore class="mb-2">
                            <select wire:model.debounce.500ms="entity.survey_id" class="custom-select form-control"
                                name="survey_id" id="survey_id">
                                <option selected>نظرسنجی را انتخاب کنید ...</option>
                                @foreach($surveys as $survey)
                                <option value="{{$survey->id}}">{{__($survey->name)}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        @elseif($field == 'effectiveness_id')
                        <div wire:ignore class="mb-2">
                            <select wire:model.debounce.500ms="entity.effectiveness_id"
                                class="custom-select form-control" name="effectiveness_id" id="effectiveness_id">
                                <option selected>اثربخشی را انتخاب کنید ...</option>
                                @foreach($effectivenesses as $effectiveness)
                                <option value="{{$effectiveness->id}}">{{__($effectiveness->name)}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        @else
                        <input wire:model.debounce.500ms="entity.{{$field}}" class="form-control  mb-2"
                            name="{{$field}}" id="{{$field}}">

                        @endif
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

            <script>
                $(document).ready(function () {
                    $('#selectedUnit-dropdown').select2();
                    $('#selectedUnit-dropdown').on('change', function (e) {
                        let data = $(this).val();
                        @this.set('selectedUnit', data);
                    });
                    window.livewire.on('stored', () => {
                        $('#selectedUnit-dropdown').select2();
                    });
                });
            </script>
        </div>
    </div>
</div>