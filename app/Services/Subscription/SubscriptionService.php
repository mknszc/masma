<?php


namespace App\Services\Subscription;


use App\Enums\OsEnum;
use App\Services\Subscription\Apple\CheckApple;
use App\Services\Subscription\Google\CheckGoogle;

class SubscriptionService implements SubscriptionInterface
{
    protected $checkapple, $checkgoogle;

    public function __construct(CheckApple $checkapple, CheckGoogle $checkgoogle)
    {
        $this->checkapple  = $checkapple;
        $this->checkgoogle = $checkgoogle;
    }

    public function checkStatus(string $receipt, string $os)
    {
        if (!$this->checkLastChar($receipt)) {
            return response()->json([
                'status'  => false,
                'message' => 'invalid purchase'
            ]);
        }

        if ($os == OsEnum::ANDROID) {
            return $this->checkgoogle->statusApp($receipt);
        }

        if ($os == OsEnum::IOS) {
            return $this->checkapple->statusApp($receipt);
        }

        return response()->json([
            'status'  => false,
            'message' => 'invalid purchase'
        ]);
    }

    public function checkLastChar(string $receipt)
    {
        $lastChar = substr($receipt, -1);

        if (is_numeric($lastChar) AND $lastChar % 2 != 0) {
            return True;
        }

        return False;
    }
}