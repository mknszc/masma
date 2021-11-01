<?php

namespace App\Services\Subscription;

interface CheckServiceInterface
{
    public function connector();

    public function statusApp(string $receipt);
}