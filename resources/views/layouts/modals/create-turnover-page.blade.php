@include('layouts.app')
<div class="container h-100 mt-5">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-10 col-md-8 col-lg-6">
            <h3>فرم اموال گردانی</h3>
            <br>
            <div>
                <form action="{{ route('turnovers/store', ['id' => $asset->id]) }}" method="POST">
                    @method('POST')
                    @csrf
                    <div>
                        <label>پلاک دارایی :</label>
                        <label>{{$asset->asset_tag}}</label>
                    </div>
                    <div>
                        <label>نام دارایی :</label>
                        <label>{{$asset->asset_name}}</label>
                    </div>
                    <div>
                        <label>واحد مربوطه :</label>
                        <label>{{$asset->unit->name}}</label>
                    </div>
                    <div>
                        <label>شخص تحویل گیرنده :</label>
                        <label>{{__($asset->user->name)}}</label>
                    </div>
                    <div>
                        <label>تاریخ تحویل :</label>
                        <label>{{$asset->delivery_date}}</label>
                    </div>
                    <div>
                        <label>محل استقرار :</label>
                        <label>{{$asset->asset_location}}</label>
                    </div>
                    <br>

                    <div>
                        <label>سابقه نقص یا مغایرت :</label>
                        @foreach ($turnoverHistories as $turnoverHistory)
                        <br>
                        <label>{!! jdate($turnoverHistory->created_at)->format('Y-m-d') !!}</label>
                        <label>توضیحات : </label>
                        <label>{{$turnoverHistory->description}}</label>
                        @endforeach
                    </div>
                    <br>

                    <div class="form-group">
                        <input type="checkbox" id="conflict" name="conflict" value="1" onclick="showDescription()">
                        <label for="conflict"> آیا نقص یا مغایرت جدید دارد ؟</label>
                    </div>
                    @error('description')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror
                    <div id="description" class="form-group" style="display:none">
                        <label for="description">توضیحات :</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">ذخیره</button>
                </form>
            </div>
            <br>
            <img src="{{ asset($asset->picture) }}" width="600" height="600">
        </div>
    </div>
</div>

<script>
    function showDescription() {
  var checkBox = document.getElementById("conflict");
  var text = document.getElementById("description");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>