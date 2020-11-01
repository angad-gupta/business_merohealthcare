<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Mail\BirthdayEmail;
use App\User;
use Mail;
use DB;
use App\Classes\GeniusMailer;
use App\Birthday;

class BirthdayNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'birthday:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Birthday description';

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
        $year = Carbon::now()->format('yy');
        // $user = User::findOrFail(128);
        // Mail::queue(new BirthdayEmail($user));

        $users = User::whereRaw("DATE_FORMAT(dob, '%m-%d') = DATE_FORMAT(now(),'%m-%d')")->orderBy('id','desc')->get();

        foreach($users as $user){
            $get_birthday_status = Birthday::where('user_id','=',$user->id)->where('year','=',$year)->first();
               
                if($get_birthday_status == null){
                    Mail::queue(new BirthdayEmail($user));
                    $birthday = new Birthday;
                    $birthday->user_id = $user->id;
                    $birthday->year = $year;
                    $birthday->status = 'sent';
                    $birthday->save();
                }
            }
    }   
}
        


