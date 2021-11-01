<?php

namespace App\Http\Controllers;

use App\Enums\OsEnum;
use App\Repositories\ApplicationRepository;
use App\Repositories\DeviceRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    protected $deviceRepository, $applicationRepository;

    public function __construct(
        DeviceRepository $deviceRepository,
        ApplicationRepository $applicationRepository)
    {
        $this->deviceRepository       = $deviceRepository;
        $this->applicationRepository  = $applicationRepository;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uid'    => 'required|string|min:3|max:255',
            'app_id' => 'required|int',
            'lang'   => 'required|string|min:2|max:2',
            'os'     => 'required|in:' . OsEnum::toList()
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages(),
            ], 400);
        }

        $application = $this->applicationRepository->getById($request->app_id);

        if (!$application) {
            return response()->json([
                'message' => "Aplication not found",
            ], 400);
        }

        $device = $this->deviceRepository->getById($request->uid, $request->app_id);

        if (!$device) {
            $device = $this->deviceRepository->create(
                $request->uid,
                $request->app_id,
                $request->os,
                $request->lang
            );
        }

        return response()->json([
            'client_token' => $device->token,
            'message'      => 'Register Ok'
        ], 200);
    }
}