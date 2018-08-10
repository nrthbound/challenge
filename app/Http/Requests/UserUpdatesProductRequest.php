<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdatesProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Another method for authorizing requests
        // See ProductController for Policy use
        $product = $this->route('product');
        if (\Auth::user()->id == $product->user_id) {
            return true;
        }

        return response()->json([
            'You are not authorized to update this product.'
        ], 403);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric'
        ];
    }
}
