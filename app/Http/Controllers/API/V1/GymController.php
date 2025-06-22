<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGymRequest;
use App\Http\Requests\UpdateGymRequest;
use App\Resources\GymResource;
use App\Services\GymService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log; // For logging

/**
 * @OA\Tag(
 * name="Gyms",
 * description="API Endpoints for managing Gyms"
 * )
 */
class GymController extends Controller
{
    use ApiResponse;

    public function __construct(protected GymService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/gyms",
     *     summary="Get list of gyms",
     *     tags={"Gyms"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function index(): JsonResponse
    {
        return $this->success(
            GymResource::collection($this->service->list()),
            'Gyms retrieved successfully',
            200
        );
    }

    /**
     * @OA\Get(
     *     path="/api/v1/gyms/{id}",
     *     summary="Show a single gym",
     *     tags={"Gyms"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id", in="path", required=true, description="Gym ID", @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function show(int $id): JsonResponse
    {
        return $this->success(
            new GymResource($this->service->show($id)),
            'Gym retrieved successfully',
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/api/v1/gyms",
     *     summary="Create new gym with sub-data",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/StoreGymRequest")
     *         )
     *     ),

     *     tags={"Gyms"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/StoreGymRequest")),
     *     @OA\Response(response=201, description="Created"),
     *     @OA\Response(response=422, description="Validation Error"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function store(StoreGymRequest $request): JsonResponse
    {
        return $this->success(
            new GymResource($this->service->store($request->validated())),
            'Gym created successfully',
            201
        );
    }


    /**
     * @OA\Post(
     *     path="/api/v1/gyms/{id}",
     *     summary="Update a gym (using POST with _method=PUT)",
     *     description="Updates gym details via POST method spoofing. Send `multipart/form-data` including a `_method` field with the exact value `PUT`.",
     *     operationId="updateGymViaPostSpoofing",
     *     tags={"Gyms"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the Gym to update",
     *          @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *        description="Gym data including the _method field for PUT spoofing.",
     *        required=true,
     *        @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *                allOf={
     *                    @OA\Schema(ref="#/components/schemas/UpdateGymRequest"),
     *                    @OA\Schema(
     *                        type="object",
     *                        required={"_method"},
     *                        @OA\Property(
     *                            property="_method",
     *                            type="string",
     *                            description="Must be set to PUT to update the resource.",
     *                            example="PUT",
     *                            enum={"PUT"}
     *                        )
     *                    )
     *                }
     *            )
     *        )
     *     ),
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Gym updated successfully"),
     *     @OA\Response(response=404, description="Gym not found"),
     *     @OA\Response(response=422, description="Validation failed"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function update(UpdateGymRequest $request, int $id): JsonResponse
    {
        return $this->success(
            new GymResource($this->service->update($id, $request->validated())),
            'Gym updated successfully',
            200
        );
    }





    /**
     * @OA\Delete(
     *     path="/api/v1/gyms/{id}",
     *     summary="Delete a gym and all related records",
     *     tags={"Gyms"},
     *    security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, description="Gym ID", @OA\Schema(type="integer")),
    *     @OA\Response(response=204, description="Gym deleted successfully"),
    *     @OA\Response(response=404, description="Gym not found"),
    *     @OA\Response(response=401, description="Unauthenticated"),
    *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->success(
            $this->service->destroy($id),
            'Gym deleted successfully',
            204
        );
    }
}
