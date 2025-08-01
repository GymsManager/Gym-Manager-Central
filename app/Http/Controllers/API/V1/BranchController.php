<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Services\BranchService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 * name="Branches",
 * description="API Endpoints for managing Branches"
 * )
 */

class BranchController extends Controller
{
    use ApiResponse;

    public function __construct(protected BranchService $service) {}

    /**
     * @OA\Get(
     *     path="/api/v1/branches",
     *     tags={"Branches"},
     *     summary="Get list of branches",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Filter by branch name",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Filter by branch status",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function index(Request $request)
    {
        return $this->service->list($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/v1/branches/{id}",
     *     tags={"Branches"},
     *     summary="Get branch by ID",
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
        return $this->service->show($id);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/branches",
     *     tags={"Branches"},
     *     summary="Create a new branch",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreBranchRequest")
     *     ),
     *     @OA\Response(response=201, description="Created"),
     *     @OA\Response(response=422, description="Validation Error"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function store(StoreBranchRequest $request)
    {
        $data = $request->validated();
        return $this->service->store($data);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/branches/{id}",
     *     tags={"Branches"},
     *     summary="Update an existing branch",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateBranchRequest")
     *     ),
     *     @OA\Response(response=200, description="Branch updated successfully"),
     *     @OA\Response(response=404, description="Branch not found"),
     *     @OA\Response(response=422, description="Validation failed"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function update(UpdateBranchRequest $request, int $id)
    {
        $data = $request->validated();
        return $this->service->update($id, $data);
    }
    /**
     * @OA\Delete(
     *     path="/api/v1/branches/{id}",
     *     tags={"Branches"},
     *     summary="Delete a branch",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
    *     @OA\Response(response=204, description="branch deleted successfully"),
    *     @OA\Response(response=404, description="branch not found"),
    *     @OA\Response(response=401, description="Unauthenticated"),
    *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function destroy(int $id)
    {
        return $this->service->destroy($id);
    }
}
