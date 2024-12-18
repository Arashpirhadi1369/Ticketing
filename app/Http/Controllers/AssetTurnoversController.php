<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use Illuminate\Http\Request;
use App\Models\AssetTurnover;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class AssetTurnoversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $asset = Asset::findOrFail($id);

        $turnoverHistories = AssetTurnover::where([['asset_id', "$id"], ['conflict', 1]])->get();

        $picture = Storage::get('assets/pictures/1.png');

        return view('layouts/modals/create-turnover-page', [
            'asset' => $asset,
            'turnoverHistories' => $turnoverHistories,
            'picture' => $picture,
            'slot' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'max:250',
        ]);

        $asset = Asset::findOrFail($request->id);

        $todayRecord = AssetTurnover::where('asset_id', $asset->id)->whereDate('created_at', Carbon::today())->get();

        if ($request->conflict == null) {
            $conflict = 0;
        } else {
            $conflict = $request->conflict;
        }

        if (isEmpty($todayRecord)) {
            AssetTurnover::create([
                'asset_id'          => $request->id,
                'user_id'           => getUserId(),
                'unit'              => $asset->unit->name,
                'belong_to_user'    => $asset->user->name,
                'asset_location'    => $asset->asset_location,
                'delivery_date'     => $asset->delivery_date,
                'conflict'          => $conflict,
                'description'       => $request->description,
            ]);

            echo "<p style='font-size:120px'>.با موفقیت ثبت شد</p>";
        } else {
            AssetTurnover::where('id', $todayRecord[0]->id)
                ->update(['conflict' => $conflict, 'description' => $request->description]);

            echo "<p style='font-size:120px'>.با موفقیت آپدیت شد</p>";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asset = Asset::findOrFail($id);

        return view('layouts/modals/create-turnover-page', ['asset' => $asset, 'slot' => null]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
