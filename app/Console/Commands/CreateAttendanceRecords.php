<?php

namespace App\Console\Commands;

use App\Models\employees;
use App\Models\attendance;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateAttendanceRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create new records for all employees in the attendance table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        employees::select('id')->get()->each(function($q){
            attendance::create([
                'employee_id'=>$q->id,
            ]);
        });
        error_log('done');
        Log::info('Done');
    }
}
