<?php

namespace App\Services;

use App\Contracts\CurServiceInteface;

class AnotherCurService implements CurServiceInteface{

    public function getRate()
    {
        dd('AnotherCurService');
    }
}