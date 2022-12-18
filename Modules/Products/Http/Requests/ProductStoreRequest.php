<?php

namespace Modules\Products\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    protected $redirectRoute = 'product.create';

    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'string',
            'stock_quantity' => 'numeric',
            'price' => 'numeric',
            'images.*' => 'image|mimes:jpg,jpeg,png,svg,gif',
            'uploaded_images' => 'array',
            'uploaded_images.*' => 'numeric'
        ];
    }
}
