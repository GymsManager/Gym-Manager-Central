<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGymRequest;
use App\Http\Requests\UpdateGymRequest;
use App\Resources\GymResource;
use App\Services\GymService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 * name="Gyms",
 * description="API Endpoints for managing Gyms"
 * )
 */
class GymController extends Controller
{
    public function __construct(protected GymService $service) {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/gyms",
     *     summary="Get list of gyms",
     *     tags={"Gyms"},
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function index(): JsonResponse
    {
        $gyms = $this->service->list();
        return response()->json(GymResource::collection($gyms));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/gyms/{id}",
     *     summary="Show a single gym",
     *     tags={"Gyms"},
     *     @OA\Parameter(
     *         name="id", in="path", required=true, @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(new GymResource($this->service->show($id)));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/gyms",
     *     summary="Create new gym with sub-data",
     *     tags={"Gyms"},
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/StoreGymRequest")),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(StoreGymRequest $request): JsonResponse
    {
        $gym = $this->service->store($request->validated());
        return response()->json(new GymResource($gym), 201);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/gyms/{id}",
     *     summary="Update a gym and its related data",
     *     tags={"Gyms"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/UpdateGymRequest")),
     *     @OA\Response(response=200, description="Updated")
     * )
     */
    public function update(UpdateGymRequest $request, int $id): JsonResponse
    {
        $gym = $this->service->update($id, $request->validated());
        return response()->json(new GymResource($gym));
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/gyms/{id}",
     *     summary="Delete a gym and all related records",
     *     tags={"Gyms"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted")
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        $this->service->destroy($id);
        return response()->json(null, 204);
    }
}
