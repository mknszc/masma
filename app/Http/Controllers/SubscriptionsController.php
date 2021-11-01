<?php

namespace App\Http\Controllers;

use App\Repositories\DeviceRepository;
use App\Repositories\SubscriptionsRepository;
use App\Services\Subscription\SubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionsController extends Controller
{
    protected $subscriptionService, $deviceRepository, $subscriptionsRepository;

    public function __construct(
        SubscriptionService $subscriptionService,
        DeviceRepository $deviceRepository,
        SubscriptionsRepository $subscriptionsRepository
    )
    {
        $this->subscriptionService     = $subscriptionService;
        $this->deviceRepository        = $deviceRepository;
        $this->subscriptionsRepository = $subscriptionsRepository;
    }

    public function purchase(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_token' => 'required|string|min:3|max:255',
            'receipt'      => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages(),
            ], 400);
        }

        $device = $this->deviceRepository->getByToken($request->client_token);

        if (!$device) {
            return response()->json([
                'message' => 'Not Device',
            ], 400);
        }

        $service = $this->subscriptionService->checkStatus($request->receipt, $device->os)->original;

        $subsription = $this->subscriptionsRepository->getByDeviceId($device->id);

        if ($service['status'] == False AND $subsription) {
            $this->subscriptionsRepository->updateCanceledById($subsription);

        } else if ($service['status'] == True AND $subsription) {
            $this->subscriptionsRepository->updateRenewedById($subsription, $service['expire_date']);

        } else if ($service['status'] == True AND !$subsription) {
            $this->subscriptionsRepository->create($device->id, $service['expire_date']);
        }

        return response()->json($service);
    }

    public function checkSubscriptionStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_token' => 'required|string|min:3|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages(),
            ], 400);
        }

        $subsription = $this->subscriptionsRepository->getSubsriptionStatus($request->client_token);

        if (!$subsription) {
            return response()->json([
                'message' => 'Not Subscription',
            ], 400);
        }

        return response()->json($subsription, 200);
    }
}
