<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeatureRequest;
use App\Http\Requests\UpdateFeatureRequest;
use App\Services\FeatureService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Features",
 *     description="API Endpoints for Features"
 * )
 */
class FeatureController extends Controller
{
    use ApiResponse;

    public function __construct(protected FeatureService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/features",
     *     summary="List all features",
     *     tags={"Features"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function index(Request $request)
    {
        return $this->success(
            $this->service->list($request->all()),
            'Features retrieved successfully',
            200
        );
    }

    /**
     * @OA\Get(
     *     path="/api/v1/features/{id}",
     *     summary="Get a feature by ID",
     *     tags={"Features"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function show(int $id)
    {
        return $this->success(
            $this->service->show($id),
            'Feature retrieved successfully',
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/api/v1/features",
     *     summary="Create a new feature",
     *     tags={"Features"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","key"},
     *             @OA\Property(property="name_en", type="string", maxLength=255, example="Live Chat"),
     *             @OA\Property(property="name_ar", type="string", maxLength=255, example="شات مباشر"),
     *             @OA\Property(property="key", type="string", example="live_chat")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created"),
     *     @OA\Response(response=422, description="Validation Error"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function store(StoreFeatureRequest $request)
    {
        return $this->success(
            $this->service->store($request->validated()),
            'Feature created successfully',
            201
        );
    }

    /**
     * @OA\Put(
     *     path="/api/v1/features/{id}",
     *     summary="Update a feature",
     *     tags={"Features"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name_en", type="string", maxLength=255, example="Live Chat"),
     *             @OA\Property(property="name_ar", type="string", maxLength=255, example="شات مباشر"),
     *             @OA\Property(property="key", type="string", example="live_chat")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated"),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=422, description="Validation Error"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function update(UpdateFeatureRequest $request, int $id)
    {
        return $this->success(
            $this->service->update($id, $request->validated()),
            'Feature updated successfully',
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/features/{id}",
     *     summary="Delete a feature",
     *     tags={"Features"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Deleted"),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function destroy(int $id)
    {
        return $this->success(
            $this->service->delete($id),
            'Feature deleted successfully',
            204
        );
    }
}
