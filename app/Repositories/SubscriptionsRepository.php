<?php

namespace App\Repositories;

use App\Enums\SubscriptionStatusEnum;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SubscriptionsRepository
{
    public function getByDeviceId(int $device_id)
    {
        return Subscription::where('device_id', $device_id)->first();
    }

    public function updateCanceledById(Subscription $subscription)
    {
        $subscription->status      = SubscriptionStatusEnum::CANCELED;
        $subscription->expire_date = Carbon::now()->format('Y-m-d H:i:s');
        $subscription->save();

        return $subscription;
    }

    public function updateRenewedById(Subscription $subscription, string $expire_date)
    {
        $subscription->status      = SubscriptionStatusEnum::RENEWED;
        $subscription->expire_date = $expire_date;;
        $subscription->save();

        return $subscription;
    }

    public function create(int $device_id, string $expire_date)
    {
        $subscription = new Subscription();
        $subscription->device_id   = $device_id;
        $subscription->status      = SubscriptionStatusEnum::STARTED;
        $subscription->expire_date = $expire_date;
        $subscription->save();

        return $subscription;
    }

    public function getSubsriptionStatus(string $token)
    {
        return DB::table('subscriptions')
                    ->leftJoin('devices', 'devices.id', '=', 'subscriptions.device_id')
                    ->where('devices.token', $token)
                    ->select('subscriptions.status as subscription_status', 'subscriptions.expire_date')
                    ->first();
    }
}