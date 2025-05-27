<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\ActionService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Actions",
 *     description="API Endpoints for managing system actions"
 * )
 */
class ActionController extends Controller
{
    public function __construct(protected ActionService $service) {}

    /**
     * @OA\Get(
     *     path="/api/v1/actions",
     *     tags={"Actions"},
     *     summary="List actions",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function index(Request $request)
    {
        return $this->service->list($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/v1/actions/{id}",
     *     tags={"Actions"},
     *     summary="Get action by ID",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/actions",
     *     tags={"Actions"},
     *     summary="Create new action",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "key"},
     *             @OA\Property(property="name", type="string", maxLength=255, example="Check-In"),
     *             @OA\Property(property="key", type="string", example="check_in")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created"
     *     )
     * )
     */
    public function store(Request $request)
    {
        return $this->service->store($request->all());
    }

    /**
     * @OA\Put(
     *     path="/api/v1/actions/{id}",
     *     tags={"Actions"},
     *     summary="Update an existing action",
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
     *             required={"name", "key"},
     *             @OA\Property(property="name", type="string", maxLength=255, example="Check-Out"),
     *             @OA\Property(property="key", type="string", example="check_out")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Updated"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($id, $request->all());
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/actions/{id}",
     *     tags={"Actions"},
     *     summary="Delete an action",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Deleted"
     *     )
     * )
     */
    public function destroy($id)
    {
        return $this->service->delete($id);
    }
}
