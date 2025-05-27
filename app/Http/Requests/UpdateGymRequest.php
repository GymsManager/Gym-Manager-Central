<?php

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

class UpdateGymRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
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
        ];
    }
}
