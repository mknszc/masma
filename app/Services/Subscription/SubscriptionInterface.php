<?php

namespace App\Services\Subscription;

interface SubscriptionInterface
{
    public function checkStatus(string $receipt, string $os);

    public function checkLastChar(string $receipt);
}