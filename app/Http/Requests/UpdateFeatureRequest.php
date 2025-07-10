<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateFeatureRequest",
 *     @OA\Property(property="name_en", type="string", maxLength=255, example="Live Chat"),
 *     @OA\Property(property="name_ar", type="string", maxLength=255, example="شات مباشر"),
 *     @OA\Property(property="key", type="string", example="live_chat")
 * )
 */
class UpdateFeatureRequest extends FormRequest
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
            'key'     => 'sometimes|string|unique:features,key,' . $this->route('id')
        ];
    }
}
