<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreActionRequest",
 *     required={"name_en", "name_ar", "key"},
 *     @OA\Property(property="name_en", type="string", maxLength=255, example="Check-In"),
 *     @OA\Property(property="name_ar", type="string", maxLength=255, example="تسجيل الدخول"),
 *     @OA\Property(property="key", type="string", example="check_in")
 * )
 */
class StoreActionRequest extends FormRequest
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
            'key' => 'required|string|max:255|unique:actions,key',
        ];
    }
}
