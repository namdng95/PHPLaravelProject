<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    public function messages()
    {
        return [
            //'required' => ':attribute khong dc de trong!',
            'email.required' => 'Email khong duoc de trong!',
            'password.required' => 'Password khong duoc de trong!',
            'name.required' => 'Ten khong duoc bo trong!',
            'phone.required' => 'So dien thoai khong duoc bo trong!',
            //'level.required' => 'Vui long nhap level!',  
        ];
    }
    public function rules()
    {
        return [
            //
            'email' => 'bail|required|email|max:255|unique:users,email',
            'password' => 'bail|required|min:6|max:60',
            'name' => 'bail|required|max:255',
            'phone' => 'bail|required|numeric',
            //'level' => 'required',        
        ];
    }
}
