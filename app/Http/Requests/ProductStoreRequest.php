<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => 'required|string|max:50|min:2',
            'category' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'color' => 'required',
            'weight' => 'required',
            'stock' => 'required|integer',
            'files.*' => 'mimes:jpeg,bmp,png,jpg,JPEG,BMP,PNG,JPG|max:2000',

        ];
    }

    /**
    * Custom message for validation
    *
    * @return array
    */
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'category.required' => 'category is required!',
            'price.required' => 'price is required!',
            'price.regex' => 'invalid price!',
            'weight.required' => 'weight is required!',
            'stock.required' => 'stock is required!',
            'stock.integer' => 'invalid stock!',
            'files.mimes' => 'invalid File(s)!',
            'files.max' => 'File size must be 2MB or lesser !',
        ];
    }

    /**
    *  Filters to be applied to the input.
    *
    * @return array
    */
    public function filters()
    {
        return [
           'name' => 'trim|capitalize|escape'
        ];
    }
}
