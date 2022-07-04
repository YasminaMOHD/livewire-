<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Manger;
use App\Models\Request;
use App\Models\Employee;
use App\Notifications\SendNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function(){
            $time =  Carbon::now()->format('Y-m-d');
            $desc = Request::where('delivery_time',$time)->get();

                foreach ($desc as $chunk){
                    $data = [
                        'title' => "اليوم موعد تسليم العمل {{$chunk->project_name}}",
                        'url' => route('admin.request')
                    ];
                    if($chunk->employee_id != null){
                        $user = User::where('id' , Employee::where('id',$chunk->employee_id)->first()->user_id)->first();
                        $user->notify(new SendNotification($data));
                        }
                        $manger = Manger::where('category_id',$chunk->category_id)->first();
                        if($manger != null){
                        $user_manger = User::where('id' , $manger->user_id)->first();
                        $user_manger->notify(new SendNotification($data));
                        }
                        $admin = User::where('user_type','admin')->first();
                        $admin->notify(new SendNotification($data));
            }
           })->daily()->onFailure(function(){
            dd('Error');
           });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
