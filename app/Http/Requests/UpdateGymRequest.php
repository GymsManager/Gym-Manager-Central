<?php

<<<<<<< HEAD
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *   schema="UpdateGymRequest",
 *   type="object",
 *   @OA\Property(property="en_name", type="string", example="Gold Gym"),
 *   @OA\Property(property="ar_name", type="string", example="جولد جيم"),
 *   @OA\Property(property="email", type="string", format="email", example="info@gym.com"),
 *   @OA\Property(property="mobile", type="string", example="+20123456789"),
 *   @OA\Property(property="subscription_plan_id", type="integer", example=2),
 *   @OA\Property(
 *     property="branding",
 *     type="object",
 *     @OA\Property(property="main_color", type="string", example="#f4b400")
 *   ),
 *   @OA\Property(
 *     property="contacts",
 *     type="object",
 *     @OA\Property(property="facebook", type="string", example="fb.com/updated")
 *   )
 * )
 */

=======

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * UpdateGymRequest Schema Definition
 *
 * @OA\Schema(
 *     schema="UpdateGymRequest",
 *     type="object",
 *     description="Schema for updating gym data. Note: The _method field is added separately in the operation definition for spoofing.",
 *     required={"en_name", "ar_name"},
 *     @OA\Property(property="en_name", type="string", example="Gold Gymsss"),
 *     @OA\Property(property="ar_name", type="string", example="جولد جيم"),
 *     @OA\Property(property="status", type="string", enum={"active", "inactive", "expired", "suspended"}),
 *     @OA\Property(property="subscription_plan_id", type="integer", example=1),
 *     @OA\Property(property="has_application", type="boolean", example=false),
 *     @OA\Property(
 *         property="features",
 *         type="object",
 *         description="JSON string or object for features",
 *         required={"feature_id", "is_enabled"},
 *         @OA\Property(property="feature_id", type="string", example="2", description="Feature ID"),
 *         @OA\Property(property="is_enabled", type="boolean", example=true, description="Indicates if this feature is enabled")
 *     ),
 *     @OA\Property(
 *         property="actions",
 *         type="object",
 *         description="JSON string or object for actions",
 *         required={"action_id", "is_enabled"},
 *         @OA\Property(property="action_id", type="string", example="2", description="Action ID"),
 *         @OA\Property(property="is_enabled", type="boolean", example=true, description="Indicates if this feature is enabled")
 *     ),
 *     @OA\Property(property="main_color", type="string", example="#111111"),
 *     @OA\Property(property="second_color", type="string", example="#eeeeee"),
 *     @OA\Property(property="en_terms", type="string", example="English terms..."),
 *     @OA\Property(property="ar_terms", type="string", example="الشروط بالعربية..."),
 *     @OA\Property(property="en_policy", type="string", example="English policy..."),
 *     @OA\Property(property="ar_policy", type="string", example="السياسة بالعربية..."),
 *
 *         @OA\Property(
 *             property="domain",
 *             type="object",
 *             required={"domain", "is_primary"},
 *             @OA\Property(property="domain", type="string", example="example.com", description="Primary domain for the gym"),
 *             @OA\Property(property="is_primary", type="boolean", example=true, description="Indicates if this is the primary domain")
 *         ),
 *
 *     @OA\Property(property="cover", type="string", format="binary", description="Branding cover image (file upload)"),
 *     @OA\Property(property="logo", type="string", format="binary", description="Branding logo image (file upload)"),
 *     @OA\Property(property="privacy_file", type="string", format="binary", description="Upload a privacy policy file (file upload)"),
 *     @OA\Property(property="side_effects_file", type="string", format="binary", description="Upload a side effects file (file upload)"),
 *     @OA\Property(property="faq_file", type="string", format="binary", description="Upload an FAQ document (file upload)")
 * )
 */
>>>>>>> 51bd07d (Gym-review)
class UpdateGymRequest extends FormRequest
{
    public function authorize(): bool
    {
<<<<<<< HEAD
        return true;
=======
        return true; // Adjust authorization logic as needed
    }

    protected function prepareForValidation()
    {
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

        if ($this->has('domain') && is_string($this->input('domain'))) {
            $decoded = json_decode($this->input('domain'), true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $this->merge([
                    'domain' => $decoded['domain'] ?? null,
                    'is_primary' => $decoded['is_primary'] ?? null,
                ]);
            }
        }

        // Handle boolean fields potentially sent as strings
        foreach (["has_application", "is_primary"] as $booleanField) {
            if ($this->has($booleanField)) {
                $this->merge([
                    $booleanField => filter_var($this->input($booleanField), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
                ]);
            }
        }
>>>>>>> 51bd07d (Gym-review)
    }

    public function rules(): array
    {
<<<<<<< HEAD
        return [
            'en_name' => 'sometimes|required|string|max:255',
            'ar_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:gyms,email,' . $this->route('id'),
            'mobile' => 'nullable|string|max:20',
            'status' => 'nullable|in:active,inactive,expired,suspended',
            'subscription_plan_id' => 'nullable|exists:subscription_plans,id',

            // Branding
            'branding.main_color' => 'nullable|string|max:20',
            'branding.second_color' => 'nullable|string|max:20',
            'branding.cover' => 'nullable|string|max:255',
            'branding.logo' => 'nullable|string|max:255',

            // Contacts
            'contacts.facebook' => 'nullable|string|max:255',
            'contacts.twitter' => 'nullable|string|max:255',
            'contacts.instagram' => 'nullable|string|max:255',
            'contacts.youtube' => 'nullable|string|max:255',
            'contacts.snapchat' => 'nullable|string|max:255',
            'contacts.whatsapp' => 'nullable|string|max:255',
            'contacts.pinterest' => 'nullable|string|max:255',

            // Addresses
            'addresses.en_address' => 'nullable|string',
            'addresses.ar_address' => 'nullable|string',

            // Policies
            'policies.en_terms' => 'nullable|string',
            'policies.ar_terms' => 'nullable|string',
            'policies.en_policy' => 'nullable|string',
            'policies.ar_policy' => 'nullable|string',

            // Config
            'config.workout_type' => 'nullable|string',
            'config.reward_points' => 'nullable|integer',
            'config.unit' => 'nullable|string',
            'config.reward_value' => 'nullable|numeric',
            'config.membership_type' => 'nullable|string',
            'config.vat' => 'nullable|numeric',
            'config.role' => 'nullable|string',
            'config.coin_login' => 'nullable|boolean',

            // Commerce
            'commerce.tax_number' => 'nullable|string|max:100',
            'commerce.merchant_id' => 'nullable|string|max:100',
            'commerce.merchant_name' => 'nullable|string|max:100',
            'commerce.merchant_key' => 'nullable|string|max:100',
            'commerce.currency' => 'nullable|string|max:10',
            'commerce.commercial_register_number' => 'nullable|string|max:100',
=======
        $gymId = $this->route("gym"); // Assuming route parameter name is 'gym'

        return [
            "en_name" => "sometimes|string|max:255",
            "ar_name" => "sometimes|string|max:255",
            "status" => "sometimes|in:active,inactive,expired,suspended",
            "subscription_plan_id" => "nullable|exists:subscription_plans,id",
            "has_application" => "nullable|boolean",

            "domain" => [
                "required_with:domain",
                "string",
                "max:255",
                Rule::unique("gym_domains", "domain")->ignore($gymId, "gym_id")
            ],
            "is_primary" => "required_with:domain|boolean",

            // Branding
            "main_color" => "nullable|string|max:20",
            "second_color" => "nullable|string|max:20",
            "cover" => "nullable|file|mimes:jpg,jpeg,png|max:2048", // Max 2MB
            "logo" => "nullable|file|mimes:jpg,jpeg,png|max:2048", // Max 2MB

            // Policies
            "en_terms" => "nullable|string",
            "ar_terms" => "nullable|string",
            "en_policy" => "nullable|string",
            "ar_policy" => "nullable|string",
            "privacy_file" => "nullable|file|mimes:pdf,doc,docx|max:2048", // Max 2MB
            "side_effects_file" => "nullable|file|mimes:pdf,doc,docx|max:2048", // Max 2MB
            "faq_file" => "nullable|file|mimes:pdf,doc,docx|max:2048", // Max 2MB

            // Actions
            "actions" => "nullable|array",
            "actions.*.action_id" => "required_with:actions|exists:actions,id",
            "actions.*.is_enabled" => "nullable|boolean",

            // Features
            "features" => "nullable|array",
            "features.*.feature_id" => "required_with:features|exists:features,id",
            "features.*.is_enabled" => "nullable|boolean",
>>>>>>> 51bd07d (Gym-review)
        ];
    }
}
