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

                        @if($field == 'course_id')
                        <div wire:ignore class="mb-2">
                            <select wire:model.debounce.500ms="entity.course_id" class="custom-select form-control"
                                name="course_id" id="course_id">
                                <option selected>دوره را انتخاب کنید ...</option>
                                @foreach($courses as $course)
                                <option value="{{$course->id}}">{{__($course->name)}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        @elseif($field == 'user_id')
                        <div wire:ignore class="mb-2">
                            <select wire:model.debounce.500ms="entity.user_id" class="custom-select form-control"
                                name="user_id" id="user_id">
                                <option selected>کارمند را انتخاب کنید ...</option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{__($user->name)}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        @elseif($field == 'unit_id')
                        <div wire:ignore class="mb-2">
                            <select wire:model.debounce.500ms="entity.unit_id" class="custom-select form-control"
                                name="unit_id" id="unit_id">
                                <option selected>واحد را انتخاب کنید ...</option>
                                @foreach($units as $unit)
                                <option value="{{$unit->id}}">{{__($unit->name)}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        @elseif($field == 'manager_user_id')
                        <div wire:ignore class="mb-2">
                            <select wire:model.debounce.500ms="entity.manager_user_id"
                                class="custom-select form-control" name="manager_user_id" id="manager_user_id">
                                <option selected>مدیر را انتخاب کنید ...</option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{__($user->name)}}
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