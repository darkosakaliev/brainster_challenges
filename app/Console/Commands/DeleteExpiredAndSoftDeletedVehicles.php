<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpiredAndSoftDeletedVehicles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vehicles:delete-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all vehicles that have been soft deleted or have an expired insurance.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Vehicle::onlyTrashed()->where('insurance_date', '<', Carbon::now())->forceDelete();
        $this->info('Deleted all expired and softdeleted records.');
    }
}
