<?php


namespace App\Enums;

final class OsEnum
{
    const ANDROID = 'android';
    const IOS     = 'ios';

    public static function toArray() {
        return array(static::ANDROID, static::IOS);
    }

    public static function toList() {
        return implode(',', self::toArray());
    }
}