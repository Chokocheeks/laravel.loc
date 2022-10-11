<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FirstCommand extends Command
{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:nbrb{currency?*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if($this->argument('currency')){
            // $currency = $this->ask('What is currency?');
            $currency = $this->secret('What is currency?');
            $this->info($currency);
        }
        // $this->argument('currency');
        $this->arguments();
        $this->info($this->option('queue'));
        return 0;
    }
}
