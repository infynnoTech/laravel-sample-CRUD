<?php

namespace App\Http\Requests;

use Crypt;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if(isset($request->category) && !empty($request->category)){

            $id = Crypt::decrypt($request->category);

            if(isset($id) && $id > 0){

                return [
                    'name' => 'required|string|max:50|min:2|unique:categories,name,'.$id.',id',
                ];
            }
        }else{
            return [
                'name' => 'required|string|max:50|min:2|unique:categories,name',
            ];
        }
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
