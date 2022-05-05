<?php

namespace Database\Seeders;

use App\Models\TicketStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['open', 'todo', 'done', 'rejected'];

        foreach ($statuses as $status) {
            TicketStatus::updateOrCreate(['status' => $status]);
        }
    }
}
