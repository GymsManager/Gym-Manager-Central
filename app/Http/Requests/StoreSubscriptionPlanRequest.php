<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreSubscriptionPlanRequest",
 *     type="object",
 *     required={"name_en","name_ar", "price", "duration"},
 *     @OA\Property(property="name_en", type="string", example="Gold Plan"),
 *     @OA\Property(property="name_ar", type="string", example="خطة الذهبيه"),
 *     @OA\Property(property="price", type="number", format="float", example=199.99),
 *     @OA\Property(property="currency", type="string", example="USD"),
 *     @OA\Property(property="is_active", type="boolean", example=true, description="Indicates if the subscription plan is active"),
 *     @OA\Property(property="duration_in_days", type="integer", example=30, description="Duration in days"),
 *     @OA\Property(property="description_en", type="string", example="Access to all gym facilities"),
 *     @OA\Property(property="description_ar", type="string", example="الوصول إلى جميع مرافق الصالة الرياضية"),
 * )
 */
class StoreSubscriptionPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_in_days' => 'required|integer|min:1',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'currency' => 'required|string|max:10',
            'is_active' => 'sometimes|boolean',
        ];
    }
}
