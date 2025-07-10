<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActionRequest;
use App\Http\Requests\UpdateActionRequest;
use App\Services\ActionService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Actions",
 *     description="API Endpoints for managing system actions"
 * )
 */
class ActionController extends Controller
{

    use ApiResponse;

    public function __construct(protected ActionService $service) {}

    /**
     * @OA\Get(
     *     path="/api/v1/actions",
     *     tags={"Actions"},
     *     summary="List actions",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function index(Request $request)
    {
        $result = $this->service->list($request->all());
        return $this->success($result, 'Actions retrieved successfully', 200);
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
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function show($id)
    {
        return $this->success($this->service->show($id), 'Action retrieved successfully', 200);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/actions",
     *     tags={"Actions"},
     *     summary="Create new action",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreActionRequest")
     *     ),
     *     @OA\Response(response=201, description="Created"),
     *     @OA\Response(response=422, description="Validation Error"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function store(StoreActionRequest $request)
    {
        return $this->success($this->service->store($request->validated()), 'Action created successfully', 201);
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
     *         @OA\JsonContent(ref="#/components/schemas/UpdateActionRequest")
     *     ),
     *     @OA\Response(response=200, description="Updated"),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=422, description="Validation Error"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function update(UpdateActionRequest $request, $id)
    {
        return $this->success($this->service->update($id, $request->validated()), 'Action updated successfully', 200);
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
     *     @OA\Response(response=204, description="Deleted"),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function destroy($id)
    {
        return $this->success($this->service->delete($id), 'Action deleted successfully', 204);
    }
}
