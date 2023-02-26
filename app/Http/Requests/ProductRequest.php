<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'  => 'required' ,
            'price'  => 'required | integer' ,
            'old_price'  => 'required | integer' ,
            'image'  => 'required ' ,
//            'available'  => 'required | boolean' ,
//            'category_id'  => 'required | exists:categories,id' ,
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'price.required' => 'A price is required',
            'old_price.required' => 'A old_price is required',
            'image.required' => 'A image is required',
            'available.required' => 'A available is required',
            'category_id.required' => 'A category_id is required',
            'price.integer' => 'A Price should be integer',
            'old_price.integer' => 'An Old Price should be integer',
            'available.boolean' => 'An available should be boolean',
            'category_id.exists' => 'A Category Id should be exist',
        ];
    }
}
