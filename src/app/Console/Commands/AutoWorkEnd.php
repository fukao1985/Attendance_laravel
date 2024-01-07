<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;


class AutoWorkEnd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'work:end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'end work automatically';

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
        $today = Carbon::today()->format('Y-m-d');
        $tomorrow = Carbon::tomorrow();
        $workOutTime = Carbon::now();
        // 今日の23:59:59の時点で退勤処理をしていないデータをWorkテーブルから取得する
        $works = Work::where('date', $today)->whereDate('work_end', '00:00:00')->get();
        // 取得したworkデータを1つずつ23:59:59で自動退勤させる
        foreach($works as $work){
            return $autoWorkEnd = $work->update([
                'user_id' => $autoWorkEnd->user_id,
                'date' => $autoWorkEnd->date,
                'work_start' => $autoWorkEnd->work_start,
                'work_end' => $workOutTime->format('H:i:s'),
            ]);
        // 自動退勤後、翌日の00:00:00で自動出勤させる
                $autoWorkStart = $work->create([
                'user_id' => $autoWorkEnd->user_id,
                'date' => $tomorrow->format('Y-m-d'),
                'work_start' => '00:00:00',
                'work_end' => '',
            ]);
        }
    }
}
