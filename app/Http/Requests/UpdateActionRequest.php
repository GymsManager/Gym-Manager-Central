<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateActionRequest",
 *     @OA\Property(property="name_en", type="string", maxLength=255, example="Check-Out"),
 *     @OA\Property(property="name_ar", type="string", maxLength=255, example="تسجيل الخروج"),
 *     @OA\Property(property="key", type="string", example="check_out")
 * )
 */
class UpdateActionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'name_en' => 'sometimes|string|max:255',
            'name_ar' => 'sometimes|string|max:255',
            'key' => 'sometimes|string|max:255|unique:actions,key,' . $id,
        ];
    }
}
