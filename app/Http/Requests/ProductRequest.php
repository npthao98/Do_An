<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ProductRequest extends FormRequest
{
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
            'name' => [
                'required',
                Rule::unique('products')->ignore($this->product),
                'max:255',
            ],
            'description' => 'required|string',
            'price_sale' => 'required|numeric',
            'images' => 'max:10240|required',
            'image' => 'max:10240|required',
            'category_id' => 'required',
        ];
    }
}
