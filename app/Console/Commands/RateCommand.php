<?php

namespace App\Console\Commands;

use App\Models\Rate;
use Illuminate\Console\Command;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'getting and saving the exchange rate at the table rates';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $query = ['pereodicity' => 0];
        $responce = Http::get('https://www.nbrb.by/api/exrates/rates', $query);
        $rate = [
            'count' => $responce['Cur_Scale'],
            'name' => $responce['Cur_Name'],
            'rate' => $responce['Cur_OfficialRate']        
        ];
        
        Rate::create($rate);
    }
}
