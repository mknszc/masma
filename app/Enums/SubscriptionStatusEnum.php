<?php

namespace App\Enums;

final class SubscriptionStatusEnum
{
    const STARTED  = 'started';
    const RENEWED  = 'renewed';
    const CANCELED = 'canceled';

    public static function toArray() {
        return array(static::STARTED, static::RENEWED, static::CANCELED);
    }
}