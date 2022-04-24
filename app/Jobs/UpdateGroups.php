<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Adldap\Laravel\Facades\Adldap;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UpdateGroups implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $adUsers = Adldap::search()->users()->get();

        $users = [];

        foreach ($adUsers as $user) {
            $users[] = $user->objectguid;
            // $users[] = $user->samaccountname;
            // $users[] = $user->memberof;
            // dump($user->samaccountname);
            // dd($user->objectguid);
            // dump($user->memberof);
        }
        dd($users);
    }
}
