<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Payment;
use Illuminate\Support\Facades\Log;

class CheckSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckSubscription:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if subscription is overdue';

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
        //

        $query = 'SELECT * FROM users
        inner join role_user on role_user.user_id = users.id
        inner join roles on roles.id = role_user.role_id
        where roles.name = "dietician"';

        $users = DB::select(DB::Raw($query));


        Foreach($users as $user){
            $user_id = $user->user_id;

            Log::info($user_id);
            $payment = Payment::where('user_id','=',$user_id)->orderby('created_at','desc')->get();
            $date = Carbon::now()->timestamp;
            $dateSubscription = strtotime($payment[0]->dateSubscription);
            Log::info($date);
            Log::info($dateSubscription);
            if($dateSubscription<$date){
                $payment[0]->status = 5;
                $payment[0]->save();
                Log::info($payment);
            }
            
        }
    }
}
