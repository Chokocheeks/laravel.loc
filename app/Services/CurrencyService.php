<?php 

namespace App\Services;

use App\Contracts\CurServiceInteface;

class CurrencyService implements CurServiceInteface{
  
    public function getRate()
    {
        dd('getRate');
    }


}