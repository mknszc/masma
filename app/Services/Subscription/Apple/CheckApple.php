<?php

namespace App\Services\Subscription\Apple;

use App\Services\Subscription\CheckServiceInterface;
use Carbon\Carbon;

class CheckApple implements CheckServiceInterface
{
    public function connector()
    {
        //Connection settings
    }

    public function statusApp(string $receipt)
    {
        $this->connector();

        return response()->json([
            'status'      => true,
            'expire_date' => Carbon::now()->addMonths(1)->format('Y-m-d H:i:s'),
        ], 200);
    }
}