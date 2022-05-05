<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogFailedLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Failed  $event
     * @return void
     */
    public function handle()
    {
        DB::table('auth_logs')->insert([
            'username'      => $this->request->username,
            'description'   => 'Failed Login',
            'ip'            => $this->request->getClientIp(),
        ]);
    }
}
