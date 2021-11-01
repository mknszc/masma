<?php

namespace App\Repositories;

use App\Models\Device;

class DeviceRepository
{
    public function getById(string $uid, int $id)
    {
        return Device::select('token')->where(['app_id' => $id, 'uid' => $uid])->first();
    }

    public function getByToken(string $token)
    {
        return Device::select('id', 'os')->where('token', $token)->first();
    }

    public function create(string $uid, int $id, string $os, string $lang)
    {
        $device = new Device();
        $device->uid    = $uid;
        $device->app_id = $id;
        $device->os     = $os;
        $device->lang   = $lang;
        $device->token  = hash('sha256', $uid . $id);
        $device->save();

        return $device;
    }
}