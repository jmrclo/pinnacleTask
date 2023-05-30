<?php

namespace App\Console\Commands;

use App\Models\announcement;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SoftDeleteExpiredRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:soft-delete-expired-records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */


    public function handle(announcement $announcement)
    {
        $end_date = $announcement->where('end_date',$announcement)->first();

        $targetDate = Carbon::now()->subDays(30); // Assuming records older than 30 days should be soft deleted
        
        $expiredRecords = announcement::where('created_at', '<=', $end_date)->get();

        foreach ($expiredRecords as $record) {
            // Perform any additional checks or operations before soft deleting the record if needed
            
            $record->delete();
        }

        $this->info('Expired records have been soft deleted successfully.');
    }
}
