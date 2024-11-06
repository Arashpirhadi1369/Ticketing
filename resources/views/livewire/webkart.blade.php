<div>
    <div class="modal-body">
        <form>
            @csrf
            <div class="form-group">

                <div>
                    <label for="">personNumber</label>
                    <input wire:model.debounce.500ms="personNumber" type="text">
                </div>

                <div>
                    <label for="">sal</label>
                    <input wire:model.debounce.500ms="year" type="text">
                </div>

                <div>
                    <label for="">mah</label>
                    <input wire:model.debounce.500ms="month" type="text">
                </div>

                az

                <div>
                    <label for="">rooz</label>
                    <input wire:model.debounce.500ms="beginDay" type="text">
                </div>

                ta

                <div>
                    <label for="">rooz</label>
                    <input wire:model.debounce.500ms="endDay" type="text">
                </div>

                <div>
                    <label for="">enterTime</label>
                    <input wire:model.debounce.500ms="beginTime" type="text">
                </div>

                <div>
                    <label for="">exitTime</label>
                    <input wire:model.debounce.500ms="endTime" type="text">
                </div>

                <div>
                    <label for="">duration</label>
                    <input wire:model.debounce.500ms="duration" type="text">
                </div>

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