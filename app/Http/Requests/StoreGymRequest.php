<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * StoreGymRequest
 *
 * @OA\RequestBody(
 *     request="StoreGymRequest",
 *     required=true,
 *     @OA\MediaType(
 *         mediaType="multipart/form-data",
 *         @OA\Schema(ref="#/components/schemas/StoreGymRequest")
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="StoreGymRequest",
 *     type="object",
 *     required={"en_name", "ar_name"},
 *     @OA\Property(property="en_name", type="string", example="Gold Gym"),
 *     @OA\Property(property="ar_name", type="string", example="جولد جيم"),
 *     @OA\Property(property="status", type="string", enum={"active", "inactive", "expired", "suspended"}),
 *     @OA\Property(property="subscription_plan_id", type="integer", example=1),
 *     @OA\Property(property="has_application", type="boolean", example=false),
 *
 * *         @OA\Property(
 *             property="features",
 *             type="object",
 *             required={"feature_id", "is_enabled"},
 *             @OA\Property(property="feature_id", type="string", example="2", description="Feature ID"),
 *             @OA\Property(property="is_enabled", type="boolean", example=true, description="Indicates if this feature is enabled")
 *         ),
 * *         @OA\Property(
 *             property="actions",
 *             type="object",
 *             required={"action_id", "is_enabled"},
 *             @OA\Property(property="action_id", type="string", example="2", description="Action ID"),
 *             @OA\Property(property="is_enabled", type="boolean", example=true, description="Indicates if this feature is enabled")
 *         ),
 *
 *         @OA\Property(property="main_color", type="string", example="#111111"),
 *         @OA\Property(property="second_color", type="string", example="#eeeeee"),
 *
 *
 *         @OA\Property(property="en_terms", type="string", example="English terms..."),
 *         @OA\Property(property="ar_terms", type="string", example="الشروط بالعربية..."),
 *         @OA\Property(property="en_policy", type="string", example="English policy..."),
 *         @OA\Property(property="ar_policy", type="string", example="السياسة بالعربية..."),
 *
 *
 *         @OA\Property(
 *             property="domain",
 *             type="object",
 *             required={"domain", "is_primary"},
 *             @OA\Property(property="domain", type="string", example="example.com", description="Primary domain for the gym"),
 *             @OA\Property(property="is_primary", type="boolean", example=true, description="Indicates if this is the primary domain")
 *         ),
 *
 *
 *     @OA\Property(property="cover", type="string", format="binary", description="Branding cover image"),
 *     @OA\Property(property="logo", type="string", format="binary", description="Branding logo image"),
 *     @OA\Property(property="privacy_file", type="string", format="binary", description="Upload a privacy policy file"),
 *     @OA\Property(property="side_effects_file", type="string", format="binary", description="Upload a side effects file"),
 *     @OA\Property(property="faq_file", type="string", format="binary", description="Upload an FAQ document"),
 * )
 */

class StoreGymRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {

        if ($this->has('domain') && is_string($this->input('domain'))) {
            $decoded = json_decode($this->input('domain'), true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $this->merge([
                    'domain' => $decoded['domain'] ?? null,
                    'is_primary' => $decoded['is_primary'] ?? null,
                ]);
            }
        }

        if ($this->has('has_application')) {
            $this->merge([
                'has_application' => filter_var($this->input('has_application'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            ]);
        }

        foreach (['actions', 'features'] as $field) {
            if ($this->has($field) && is_string($this->input($field))) {
                $rawString = $this->input($field);

                if (strpos($rawString, '{') !== false && strpos($rawString, '}') !== false && strpos($rawString, ',') !== false) {
                    $rawString = '[' . $rawString . ']';
                }

                $decoded = json_decode($rawString, true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    $this->merge([$field => $decoded]);
                } else {
                    throw new \Exception("Invalid JSON format for field: $field");
                }
            }
        }

        $this->merge([
            'has_application' => filter_var($this->has_application, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'is_primary' => filter_var($this->is_primary, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        ]);
    }

    public function rules(): array
    {

        return [
            'en_name' => 'required|string|max:255',
            'ar_name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:gyms,email',
            // 'mobile' => 'required|string|max:20',
            'status' => 'required|in:active,inactive,expired,suspended',
            'subscription_plan_id' => 'nullable|exists:subscription_plans,id',
            'has_application' => 'nullable|boolean',

            // Domain
            'domain' => 'required|string|regex:/^(?!:\/\/)([a-zA-Z0-9-_]+\.)+[a-zA-Z]{2,}$/|max:255|unique:gym_domains,domain',
            'is_primary' => 'required|boolean',

            // Branding
            'main_color' => 'nullable|string|max:20',
            'second_color' => 'nullable|string|max:20',
            'cover' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'logo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',

            // Policies
            'en_terms' => 'nullable|string',
            'ar_terms' => 'nullable|string',
            'en_policy' => 'nullable|string',
            'ar_policy' => 'nullable|string',
            'privacy_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'side_effects_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'faq_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',

            // Actions
            'actions' => 'nullable|array',
            'actions.*.action_id' => 'required|exists:actions,id',
            'actions.*.is_enabled' => 'nullable|boolean',

            // Features
            'features' => 'nullable|array',
            'features.*.feature_id' => 'required|exists:features,id',
            'features.*.is_enabled' => 'nullable|boolean',
        ];
    }
}
