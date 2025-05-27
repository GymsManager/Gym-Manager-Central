<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreBranchRequest",
 *     type="object",
 *     required={"en_name", "ar_name", "gym_id", "city_id", "subscribe_date", "expire_date", "capacity", "status"},
 *     @OA\Property(property="en_name", type="string", example="Main Branch"),
 *     @OA\Property(property="ar_name", type="string", example="الفرع الرئيسي"),
 *     @OA\Property(property="gym_id", type="integer", example=1),
 *     @OA\Property(property="city_id", type="integer", example=1),
 *     @OA\Property(property="subscribe_date", type="string", format="date", example="2024-01-01"),
 *     @OA\Property(property="expire_date", type="string", format="date", example="2024-12-31"),
 *     @OA\Property(property="capacity", type="integer", example=100),
 *     @OA\Property(property="status", type="string", enum={"active", "inactive"}, example="active"),
 *     @OA\Property(
 *         property="contact",
 *         type="object",
 *         @OA\Property(property="facebook", type="string", example="https://facebook.com/branch"),
 *         @OA\Property(property="twitter", type="string", example="https://twitter.com/branch")
 *     ),
 *     @OA\Property(
 *         property="addresses",
 *         type="object",
 *         @OA\Property(property="address", type="string", example="123 Main St"),
 *         @OA\Property(property="latitude", type="number", format="float", example=30.0444),
 *         @OA\Property(property="longitude", type="number", format="float", example=31.2357)
 *     ),
 *     @OA\Property(property="configs", type="object"),
 *     @OA\Property(property="commerces", type="object")
 * )
 */
class StoreBranchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'en_name' => 'required|string|max:255',
            'ar_name' => 'required|string|max:255',
            'gym_id' => 'required|integer|exists:gyms,id',
            'city_id' => 'required|integer|exists:cities,id',
            'subscribe_date' => 'required|date',
            'expire_date' => 'required|date',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|string|in:active,inactive',
            'contact' => 'nullable|array',
            'contact.*' => 'nullable|url',
            'addresses' => 'nullable|array',
            'addresses.address' => 'nullable|string|max:255',
            'addresses.latitude' => 'nullable|numeric',
            'addresses.longitude' => 'nullable|numeric',
            'configs' => 'nullable|array',
            'commerces' => 'nullable|array',
        ];
    }
}
