<?php

namespace App\Console\Commands;

use App\Mail\FirstMail;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class FirstCommand extends Command
{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:nbrb{currency?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending currency exchange rates to the mail';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // if($this->argument('currency')){
        //     // $currency = $this->ask('What is currency?');
        //     $currency = $this->secret('What is currency?');
        //     $this->info($currency);
        // }
        // // $this->argument('currency');
        // $this->arguments();
        // $this->info($this->option('queue'));
        // return 0;


            $Cur_Abbreviation = strtoupper($this->ask('What currency rate do you want to know?'));
            $email = $this->ask('What is your email?');
            $responce = Http::get('https://www.nbrb.by/api/exrates/rates/'.$Cur_Abbreviation.'?parammode=2 ');
            $details = [
                'Currency' => $responce['Cur_Name'],
                'Cur_Scale' => $responce['Cur_Scale'],
                'Cur_OfficialRate' => $responce['Cur_OfficialRate']
            ];
            $mail = new FirstMail($email, $details);
            // $this->info($mail);
            Mail::send($mail);
            
        $this->info('Send currency rates - successfully!');
    }
   
}
