<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

/**
 * StoreGymRequest
 *
 * @OA\RequestBody(
 *     request="StoreGymRequest",
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/StoreGymRequest")
 * )
 *
 * @OA\Schema(
 *     schema="StoreGymRequest",
 *     type="object",
 *     required={"en_name", "ar_name", "email"},
 *     @OA\Property(property="en_name", type="string", example="Gold Gym"),
 *     @OA\Property(property="ar_name", type="string", example="جولد جيم"),
 *     @OA\Property(property="email", type="string", format="email", example="gold@gym.com"),
 *     @OA\Property(property="mobile", type="string", example="+20123456789"),
 *     @OA\Property(property="status", type="string", enum={"active", "inactive", "expired", "suspended"}),
 *     @OA\Property(property="subscription_plan_id", type="integer", example=1),

 *     @OA\Property(
 *         property="branding",
 *         type="object",
 *         @OA\Property(property="main_color", type="string", example="#111111"),
 *         @OA\Property(property="second_color", type="string", example="#eeeeee"),
 *         @OA\Property(property="cover", type="string", format="binary"),
 *         @OA\Property(property="logo", type="string", format="binary")
 *     ),

 *     @OA\Property(
 *         property="policies",
 *         type="object",
 *         @OA\Property(property="en_terms", type="string", example="English terms..."),
 *         @OA\Property(property="ar_terms", type="string", example="الشروط بالعربية..."),
 *         @OA\Property(property="en_policy", type="string", example="English policy..."),
 *         @OA\Property(property="ar_policy", type="string", example="السياسة بالعربية..."),
 *         @OA\Property(property="privacy_file", type="string", format="binary", description="Upload a privacy policy file"),
 *         @OA\Property(property="side_effects_file", type="string", format="binary", description="Upload a side effects file"),
 *         @OA\Property(property="faq_file", type="string", format="binary", description="Upload an FAQ document")
 *     ),

 *     @OA\Property(
 *         property="domain",
 *         type="object",
 *         required={"domain"},
 *         @OA\Property(property="domain", type="string", example="example.com"),
 *         @OA\Property(property="is_primary", type="boolean", example=true)
 *     )
 * )
 */

class StoreGymRequest extends FormRequest
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
            'email' => 'required|email|unique:gyms,email',
            'mobile' => 'required|string|max:20',
            'status' => 'required|in:active,inactive,expired,suspended',
            'subscription_plan_id' => 'nullable|exists:subscription_plans,id',
            'has_application' => 'nullable|boolean',

            //Domain
            'domain.domain' => 'required|string|regex:/^(?!:\/\/)([a-zA-Z0-9-_]+\.)+[a-zA-Z]{2,}$/|max:255|unique:gyms,domain',
            'domain.is_primary' => 'nullable|boolean',

            // Branding
            'branding.main_color' => 'nullable|string|max:20',
            'branding.second_color' => 'nullable|string|max:20',
            'branding.cover' => 'nullable|string|max:255',
            'branding.logo' => 'nullable|string|max:255',

            // Policies
            'policies.en_terms' => 'nullable|string',
            'policies.ar_terms' => 'nullable|string',
            'policies.en_policy' => 'nullable|string',
            'policies.ar_policy' => 'nullable|string',
            'policies.privacy_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'policies.side_effects_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'policies.faq_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',

        ];
    }
}
