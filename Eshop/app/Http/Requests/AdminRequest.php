<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
    public function attributes()
    {
        return [
            'admin_email' => "Email",
            'admin_password' => "Password",
        ];
    }
    public function messages()
    {
        return [
            //'required' => ':attribute khong dc de trong!',
            'admin_email.required' => ':attribute khong duoc de trong!',
            'admin_password.required' => ':attribute khong duoc de trong!',
        ];
    }
    public function rules()
    {
        return [
            //
            'admin_email' => 'bail|required|email|max:255',
            'admin_password' => 'bail|required',
        ];
    }
}
