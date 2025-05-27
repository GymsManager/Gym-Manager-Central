<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateSubscriptionPlanRequest",
 *     type="object",
 *     @OA\Property(property="name", type="string", example="Gold Plan"),
 *     @OA\Property(property="price", type="number", format="float", example=199.99),
 *     @OA\Property(property="duration", type="integer", example=30, description="Duration in days"),
 *     @OA\Property(property="description", type="string", example="Access to all gym facilities")
 * )
 */
class UpdateSubscriptionPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'duration' => 'sometimes|required|integer|min:1',
            'description' => 'nullable|string',
        ];
    }
}
