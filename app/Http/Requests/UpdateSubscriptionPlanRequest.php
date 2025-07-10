<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateSubscriptionPlanRequest",
 *     type="object",
 *     @OA\Property(property="name_en", type="string", example="Updated Gold Plan"),
 *     @OA\Property(property="name_ar", type="string", example="خطة الذهبيه المحدّثة"),
 *     @OA\Property(property="price", type="number", format="float", example=149.99),
 *     @OA\Property(property="currency", type="string", example="USD"),
 *     @OA\Property(property="is_active", type="boolean", example=true),
 *     @OA\Property(property="duration_in_days", type="integer", example=60),
 *     @OA\Property(property="description_en", type="string", example="Updated access to all gym facilities"),
 *     @OA\Property(property="description_ar", type="string", example="تحديث الوصول إلى جميع مرافق الصالة الرياضية"),
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
            'name_en' => 'sometimes|string|max:255',
            'name_ar' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric|min:0',
            'duration_in_days' => 'sometimes|integer|min:1',
            'currency' => 'sometimes|string|max:10',
            'is_active' => 'sometimes|boolean',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
        ];
    }
}
