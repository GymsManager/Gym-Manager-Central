<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\FeatureService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Features",
 *     description="API Endpoints for Features"
 * )
 */
class FeatureController extends Controller
{
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
     *     @OA\Response(
     *         response=200,
     *         description="List of features"
     *     )
     * )
     */
    public function index(Request $request)
    {
        return $this->service->list($request->all());
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
     *     @OA\Response(
     *         response=200,
     *         description="Feature details"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Feature not found"
     *     )
     * )
     */
    public function show(int $id)
    {
        return $this->service->show($id);
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
     *             @OA\Property(property="name", type="string", maxLength=255),
     *             @OA\Property(property="key", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Feature created"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'key' => 'required|string',
        ]);

        return $this->service->store($validated);
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
     *             @OA\Property(property="name", type="string", maxLength=255),
     *             @OA\Property(property="key", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Feature updated"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'key' => 'sometimes|required|string',
        ]);

        return $this->service->update($id, $validated);
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
     *     @OA\Response(
     *         response=204,
     *         description="Feature deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Feature not found"
     *     )
     * )
     */
    public function destroy(int $id)
    {
        return $this->service->delete($id);
    }
}
