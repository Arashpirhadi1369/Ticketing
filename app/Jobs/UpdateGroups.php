<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Adldap\Laravel\Facades\Adldap;
use App\Models\User;
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
            $users[] = $user->samaccountname[0];
        }

        $details = [];

        foreach ($adUsers as $user) {
            $details[] = $user->distinguishedname;
        }

        $usersWithDetails = array_combine($users, $details);

        $clean = [];

        foreach ($usersWithDetails as $key => $value) {
            if (!empty($value)) {
                foreach ($value as $detail) {
                    $x = strstr($detail, 'OU=');
                    $y = strstr($x, ',', true);
                    $ou = ltrim($y, "OU=");

                    $clean[$key] = $ou;

                    break;
                }
            }
        }
        foreach ($clean as $key => $value) {
            User::where('username', $key)->update(['ou' => $value]);
        }
    }
}
