<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Services\CityService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use ApiResponse;

    /**
     * @OA\Tag(
     *     name="Cities",
     *     description="API Endpoints for managing cities"
     * )
     */

    public function __construct(protected CityService $service) {}

    /**
     * @OA\Get(
     *     path="/api/v1/cities",
     *     tags={"Cities"},
     *     summary="Get list of cities",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="filter",
     *         in="query",
     *         description="Optional filters",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
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
     *     path="/api/v1/cities/{id}",
     *     tags={"Cities"},
     *     summary="Get city by ID",
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
     *         description="City not found"
     *     )
     * )
     */
    public function show(int $id)
    {
        return $this->service->show($id);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/cities",
     *     tags={"Cities"},
     *     summary="Create a new city",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name_en", type="string" , example="City Name"),
     *             @OA\Property(property="name_ar", type="string" ,example="المدينة"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="City created"
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
            'name_en' => 'required|string',
            'name_ar' => 'nullable|string',
        ]);

        return $this->service->store($request->all());
    }

    /**
     * @OA\Put(
     *     path="/api/v1/cities/{id}",
     *     tags={"Cities"},
     *     summary="Update a city",
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
     *             type="object",
     *            @OA\Property(property="name_en", type="string", example="Updated City Name"),
     *            @OA\Property(property="name_ar", type="string", example="المدينة المحدثة"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="City updated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="City not found"
     *     )
     * )
     */
    public function update(Request $request, City $city)
    {
        return $this->service->update($city, $request->all());
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/cities/{id}",
     *     tags={"Cities"},
     *     summary="Delete a city",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="City deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="City not found"
     *     )
     * )
     */
    public function destroy(int $id)
    {
        return $this->service->delete($id);
    }
}
