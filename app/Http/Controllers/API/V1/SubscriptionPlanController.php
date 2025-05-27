<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscriptionPlanRequest;
use App\Http\Requests\UpdateSubscriptionPlanRequest;
use App\Services\SubscriptionPlanService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Subscription Plans",
 *     description="API Endpoints for managing subscription plans"
 * )
 */
class SubscriptionPlanController extends Controller
{
    use ApiResponse;

    public function __construct(protected SubscriptionPlanService $service) {}

    /**
     * @OA\Get(
     *     path="/api/v1/subscription-plans",
     *     tags={"Subscription Plans"},
     *     summary="List all subscription plans",
     *     @OA\Response(response=200, description="Success"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function index(): JsonResponse
    {
        $plans = $this->service->list();
        return $this->success($plans, 'Subscription plans retrieved successfully');
    }

    /**
     * @OA\Get(
     *     path="/api/v1/subscription-plans/{id}",
     *     tags={"Subscription Plans"},
     *     summary="Get a specific subscription plan",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Success"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function show(int $id): JsonResponse
    {
        $plan = $this->service->show($id);
        return $this->success($plan, 'Subscription plan retrieved successfully');
    }

    /**
     * @OA\Post(
     *     path="/api/v1/subscription-plans",
     *     tags={"Subscription Plans"},
     *     summary="Create a new subscription plan",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreSubscriptionPlanRequest")
     *     ),
     *     @OA\Response(response=201, description="Created"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function store(StoreSubscriptionPlanRequest $request): JsonResponse
    {
        $plan = $this->service->store($request->validated());
        return $this->success($plan, 'Subscription plan created successfully', 201);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/subscription-plans/{id}",
     *     tags={"Subscription Plans"},
     *     summary="Update a subscription plan",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateSubscriptionPlanRequest")
     *     ),
     *     @OA\Response(response=200, description="Updated"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function update(int $id, UpdateSubscriptionPlanRequest $request): JsonResponse
    {
        $plan = $this->service->update($id, $request->validated());
        return $this->success($plan, 'Subscription plan updated successfully');
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/subscription-plans/{id}",
     *     tags={"Subscription Plans"},
     *     summary="Delete a subscription plan",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return $this->success(null, 'Subscription plan deleted successfully', 204);
    }
}
