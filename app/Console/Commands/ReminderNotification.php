<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Mail\ReminderMail;
use App\Reminder;
use Mail;

class ReminderNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ReminderNotification:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends Daily Notifications and Reminders.';

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
     * @return mixed
     */
    public function handle()
    {
        $today = Carbon::today();

        foreach(Reminder::where('status',1)->get() as $reminder){
            $date = Carbon::parse($reminder->start_date);

            while($date < $today){
                $date->addDays($reminder->duration);
            }
            
            $notification_date = clone $date;
            $checkDate = $date->subDays(3);
            
            if($today >= $checkDate && $today <= $notification_date){
                $prescription = $reminder->notifiable;
                $user = $prescription->user;

                if($user){
                    $diff = $notification_date->diffInDays($today);
                    if($diff == 1) $text = 'tomorrow';
                    else if($diff == 0) $text = 'today';
                    else  $text = 'in '.$diff.' days';

                    $content = "Your prescription '".$prescription->title."' is scheduled to be reordered ".$text.". Please reorder soon.";

                    Mail::to($user->email)->queue(new ReminderMail($user,'Reminder For Prescription Re-order',$content,route('user-prescriptions.index')));
                }
            }
            
        }
    }
}
