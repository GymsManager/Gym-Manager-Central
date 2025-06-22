<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateSubscriptionPlanRequest",
 *     type="object",
<<<<<<< HEAD
 *     @OA\Property(property="name", type="string", example="Gold Plan"),
 *     @OA\Property(property="price", type="number", format="float", example=199.99),
 *     @OA\Property(property="duration", type="integer", example=30, description="Duration in days"),
 *     @OA\Property(property="description", type="string", example="Access to all gym facilities")
=======
 *     @OA\Property(property="name_en", type="string", example="Updated Gold Plan"),
 *     @OA\Property(property="name_ar", type="string", example="خطة الذهبيه المحدّثة"),
 *     @OA\Property(property="price", type="number", format="float", example=149.99),
 *     @OA\Property(property="currency", type="string", example="USD"),
 *     @OA\Property(property="is_active", type="boolean", example=true),
 *     @OA\Property(property="duration_in_days", type="integer", example=60),
 *     @OA\Property(property="description_en", type="string", example="Updated access to all gym facilities"),
 *     @OA\Property(property="description_ar", type="string", example="تحديث الوصول إلى جميع مرافق الصالة الرياضية"),
>>>>>>> 51bd07d (Gym-review)
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
<<<<<<< HEAD
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'duration' => 'sometimes|required|integer|min:1',
            'description' => 'nullable|string',
=======
            'name_en' => 'sometimes|string|max:255',
            'name_ar' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric|min:0',
            'duration_in_days' => 'sometimes|integer|min:1',
            'currency' => 'sometimes|string|max:10',
            'is_active' => 'sometimes|boolean',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
>>>>>>> 51bd07d (Gym-review)
        ];
    }
}
