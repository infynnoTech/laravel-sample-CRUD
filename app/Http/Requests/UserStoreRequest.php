<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'email'   =>'email|Unique:users',
            'password' =>'required|min:6|max:20|not_in:0',
			'passwordAgain' =>'required|same:password|not_in:0',
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
            'email.required' => 'Email is required!',
            'email.email' => 'Email is Invalid!',
            'password.same' =>'password not match',
			'passwordAgain.required' =>'Confirm password is required',
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
