<?php

namespace App\Console\Commands;

use App\Models\TeamMatch;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GetResultsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:results';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Match Results every 24 hours!';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $matches = TeamMatch::where('date', '<', Carbon::parse('-24 hours'))->get();
        if ($matches) {
            foreach($matches as $match) {
                $match->results = rand(0, 5) . '-' . rand(0,5);
                $match->save();
            }
            return $this->info('Successfully added results!');
        } else {
            return $this->warning('No results have been added!');
        }
    }
}
