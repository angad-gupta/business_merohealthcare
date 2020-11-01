<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutValidationRequest extends FormRequest
{
    // protected $errorBag = 'checkoutForm';
  /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shipping' => 'required|in:shipto,pickup',
            'pickup_location' => 'required_if:shipping,pickup',
            'email' => 'required|email',
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            // 'landmark' => 'required|string',
            'address_type' => 'required|in:Home,Office',
            // 'city' => 'required',
            // 'zip' => 'nullable|numeric',
            'pan_number' => 'nullable|numeric',
            'customer_country' => 'required',
            'shipping_email' => 'required_if:shippingCheck,check|nullable|email',
            'shipping_name' => 'required_if:shippingCheck,check',
            'shipping_phone' => 'required_if:shippingCheck,check|nullable|string',
            'shipping_address' => 'required_if:shippingCheck,check',
            // 'shipping_landmark' => 'required_if:shippingCheck,check|nullable|string',
            'shipping_address_type' => 'required_if:shippingCheck,check|in:Home,Office',
            // 'shipping_city' => 'required_if:shippingCheck,check',
            // 'shipping_zip' => 'nullable|numeric',
            'shipping_pan_number' => 'nullable|numeric',
            'shipping_country' => 'required_if:shippingCheck,check',
        ];
    }

    public function messages()
    {
        return [
            // 'cat_slug.unique' => 'This slug has already been taken.',
            // 'sub_slug.unique' => 'This slug has already been taken.',
            // 'child_slug.unique' => 'This slug has already been taken.',
        ];
    }
}
