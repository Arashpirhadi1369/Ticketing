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
                        @if ($field == 'asset_unit_id')
                        <div wire:ignore class="mb-2">
                            <div>
                                <label class="mr-2" for="{{$field}}">{{__($field)}}</label>
                                @error("entity.$field")<span class="mr-2  text-danger">{{ $message
                                    }}</span>@enderror
                            </div>
                            <select wire:model.debounce.500ms="entity.asset_unit_id" class="custom-select form-control"
                                name="asset_unit_id" id="asset_unit_id">
                                <option selected>واحد را انتخاب کنید ...</option>
                                @foreach($units as $unit)
                                <option value="{{$unit->id}}">{{__($unit->name)}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        @elseif($field == 'belong_to_user')
                        <div wire:ignore class="mb-2">
                            <div>
                                <label class="mr-2" for="{{$field}}">{{__($field)}}</label>
                                @error("entity.$field")<span class="mr-2  text-danger">{{ $message
                                    }}</span>@enderror
                            </div>
                            <select wire:model.debounce.500ms="entity.belong_to_user" class="custom-select form-control"
                                name="belong_to_user" id="belong_to_user">
                                <option selected>شخص را انتخاب کنید ...</option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{__($user->name)}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        @else
                        <div>
                            <label class="mr-2" for="{{$field}}">{{__($field)}}</label>
                            @error("entity.$field")<span class="mr-2  text-danger">{{ $message
                                }}</span>@enderror
                        </div>

                        <input wire:model.debounce.500ms="entity.{{$field}}" class="form-control  mb-2"
                            name="{{$field}}" id="{{$field}}">
                        @endif
                        @endforeach

                        <div>
                            <label>بارگذاری تصویر</label>
                        </div>
                        <div>
                            <label class="mr-2" for="picture"></label>
                            @error("picture")<span class="mr-2  text-danger">{{ $message
                                }}</span>@enderror
                        </div>
                        <div wire:ignore x-data x-init="FilePond.setOptions({
                            server:{
                                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) =>{
                                    @this.upload('picture', file, load, error, progress)
                                },
                                revert: (filename, load) => {@this.removeUpload('picture', filename, load)},
                            },
                        }); 
                        var Pond = FilePond.create($refs.input); 

                        this.addEventListener('pondReset', e => {
                            Pond.removeFiles();
                        });">
                            <input x-ref="input" type="file">
                        </div>

                        @role("administrator")
                        <div>
                            <label>بارگذاری اکسل</label>
                        </div>
                        <div>
                            <label class="mr-2" for="importExcel"></label>
                            @error("importExcel")<span class="mr-2  text-danger">{{ $message
                                }}</span>@enderror
                        </div>
                        <div wire:ignore x-data x-init="FilePond.setOptions({
                            server:{
                                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) =>{
                                    @this.upload('importExcel', file, load, error, progress)
                                },
                                revert: (filename, load) => {@this.removeUpload('importExcel', filename, load)},
                            },
                        }); 
                        var Pond = FilePond.create($refs.input); 

                        this.addEventListener('pondReset', e => {
                            Pond.removeFiles();
                        });">
                            <input x-ref="input" type="file">
                        </div>
                        @endrole

                        <div class="mt-4 modal-footer">
                            <button wire:click.prevent="store" type="submit" class="btn btn-info mt-2">ذخیره
                            </button>
                            @role('administrator')
                            <button wire:click.prevent="storeExcel" type="submit" class="btn btn-danger mt-2">ذخیره فایل
                                اکسل
                            </button>
                            @endrole
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