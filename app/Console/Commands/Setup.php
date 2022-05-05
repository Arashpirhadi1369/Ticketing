<?php

namespace App\Console\Commands;

use App\Jobs\UpdateGroups;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup The Application';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(UpdateGroups $updateGroups)
    {
        Artisan::call('db:seed');
        Artisan::call('adldap:import', ['-n']);
        $updateGroups->handle();
    }
}
