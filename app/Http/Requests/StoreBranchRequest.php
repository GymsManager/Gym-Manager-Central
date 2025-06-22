<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreBranchRequest",
 *     type="object",
 *     required={"en_name", "ar_name", "gym_id", "city_id", "subscribe_date", "expire_date", "capacity", "status"},
 *     @OA\Property(property="en_name", type="string", example="Main Branch"),
 *     @OA\Property(property="ar_name", type="string", example="الفرع الرئيسي"),
 *     @OA\Property(property="gym_id", type="integer", example=1),
 *     @OA\Property(property="city_id", type="integer", example=1),
 *     @OA\Property(property="subscribe_date", type="string", format="date", example="2024-01-01"),
 *     @OA\Property(property="expire_date", type="string", format="date", example="2024-12-31"),
 *     @OA\Property(property="capacity", type="integer", example=100),
 *     @OA\Property(property="status", type="string", enum={"active", "inactive"}, example="active"),
 *     @OA\Property(
 *         property="contact",
 *         type="object",
 *         @OA\Property(property="facebook", type="string", example="https://facebook.com/branch"),
 *         @OA\Property(property="twitter", type="string", example="https://twitter.com/branch"),
 *         @OA\Property(property="instagram", type="string", example="https://instagram.com/branch"),
 *         @OA\Property(property="youtube", type="string", example="https://youtube.com/branch"),
 *         @OA\Property(property="snapchat", type="string", example="https://snapchat.com/branch"),
 *         @OA\Property(property="whatsapp", type="string", example="https://wa.me/123456789"),
 *         @OA\Property(property="pinterest", type="string", example="https://pinterest.com/branch")
 *     ),
 *     @OA\Property(
 *         property="addresses",
 *         type="object",
 *         @OA\Property(property="address", type="string", example="123 Main St"),
 *         @OA\Property(property="latitude", type="number", format="float", example=30.0444),
 *         @OA\Property(property="longitude", type="number", format="float", example=31.2357)
 *     ),
 *     @OA\Property(property="configs", type="object",
 *        @OA\Property(property="skip_days", type="array", @OA\Items(type="string", example="Monday")),
 *        @OA\Property(property="workout_type", type="string", example="cardio"),
 *        @OA\Property(property="reward_points", type="integer", example=100),
 *        @OA\Property(property="unit", type="string", example="session"),
 *        @OA\Property(property="reward_value", type="number", format="float", example=10.5),
 *        @OA\Property(property="membership_type", type="string", example="gold"),
 *        @OA\Property(property="vat", type="number", format="float", example=14.0),
 *        @OA\Property(property="coin_login", type="boolean", example=true),
 *     ),
 *     @OA\Property(
 *         property="commerces",
 *         type="object",
 *         @OA\Property(property="tax_number", type="string", example="123456789"),
 *         @OA\Property(property="merchant_id", type="string", example="MID123456"),
 *         @OA\Property(property="merchant_name", type="string", example="Merchant Name"),
 *         @OA\Property(property="merchant_key", type="string", example="key_abcdef123456"),
 *         @OA\Property(property="currency", type="string", example="EGP"),
 *         @OA\Property(property="commercial_register_number", type="string", example="CRN987654")
 *     )
 * )
 */
class StoreBranchRequest extends FormRequest
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
            'gym_id' => 'required|integer|exists:gyms,id',
            'city_id' => 'required|integer|exists:cities,id',
            'subscribe_date' => 'required|date',
            'expire_date' => 'required|date|after_or_equal:subscribe_date',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|string|in:active,inactive',

            'contact' => 'nullable|array',
            'contact.facebook' => 'nullable|url',
            'contact.twitter' => 'nullable|url',
            'contact.instagram' => 'nullable|url',
            'contact.youtube' => 'nullable|url',
            'contact.snapchat' => 'nullable|url',
            'contact.whatsapp' => 'nullable|url',
            'contact.pinterest' => 'nullable|url',

            'addresses' => 'nullable|array',
            'addresses.address' => 'nullable|string|max:255',
            'addresses.latitude' => 'nullable|numeric',
            'addresses.longitude' => 'nullable|numeric',

            'configs' => 'nullable|array',
            'configs.skip_days' => 'nullable|array',
            'configs.skip_days.*' => 'nullable|string',
            'configs.workout_type' => 'nullable|string|max:255',
            'configs.reward_points' => 'nullable|integer',
            'configs.unit' => 'nullable|string|max:255',
            'configs.reward_value' => 'nullable|numeric',
            'configs.membership_type' => 'nullable|string|max:255',
            'configs.vat' => 'nullable|numeric',
            'configs.coin_login' => 'nullable|boolean',

            'commerces' => 'nullable|array',
            'commerces.tax_number' => 'nullable|string|max:255',
            'commerces.merchant_id' => 'nullable|string|max:255',
            'commerces.merchant_name' => 'nullable|string|max:255',
            'commerces.merchant_key' => 'nullable|string|max:255',
            'commerces.currency' => 'nullable|string|max:10',
            'commerces.commercial_register_number' => 'nullable|string|max:255',
        ];
    }
}
