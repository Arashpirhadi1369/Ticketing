<?php

namespace App\Observers;

use App\Models\Asset;
use App\Models\UserLog;

class AssetObserver
{
    /**
     * Handle the Asset "created" event.
     *
     * @param  \App\Models\Asset  $asset
     * @return void
     */
    public function created(Asset $asset)
    {
        UserLog::create([
            'ip' => request()->ip(),
            'user_id' => request()->user()->id,
            'table_id' => UserLog::getTableId($asset->getTable()),
            'action_id' => 1,
            'record_id' => $asset->id
        ]);
    }

    /**
     * Handle the Asset "updated" event.
     *
     * @param  \App\Models\Asset  $asset
     * @return void
     */
    public function updated(Asset $asset)
    {
        $changes = UserLog::getChangesAfterUpdate($asset);

        if ($changes) {
            foreach ($changes as $change) {
                foreach ($change as $key => $value) {
                    UserLog::create([
                        'ip'        => request()->ip(),
                        'user_id'   => request()->user()->id,
                        'table_id'  => UserLog::getTableId($asset->getTable()),
                        'action_id' => 2,
                        'record_id' => $asset->id,
                        'attribute' => $key,
                        'old'       => $value['old'],
                        'new'       => $value['new']
                    ]);
                }
            }
        }
    }

    /**
     * Handle the Asset "deleted" event.
     *
     * @param  \App\Models\Asset  $asset
     * @return void
     */
    public function deleted(Asset $asset)
    {
        UserLog::create([
            'ip' => request()->ip(),
            'user_id' => request()->user()->id,
            'table_id' => UserLog::getTableId($asset->getTable()),
            'action_id' => 3,
            'record_id' => $asset->id
        ]);
    }

    /**
     * Handle the Asset "restored" event.
     *
     * @param  \App\Models\Asset  $asset
     * @return void
     */
    public function restored(Asset $asset)
    {
        //
    }

    /**
     * Handle the Asset "force deleted" event.
     *
     * @param  \App\Models\Asset  $asset
     * @return void
     */
    public function forceDeleted(Asset $asset)
    {
        //
    }
}
