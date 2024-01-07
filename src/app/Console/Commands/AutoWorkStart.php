<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;

class AutoWorkStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'work:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'start work automatically';

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
        //
        $yesterday = Carbon::yesterday();
        $works = Work::where('date', $yesterday)->whereDate('work_end', '00:00:00')->get();

    }
}
