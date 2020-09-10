<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'brand_name' => "Name's Brand",
            'brand_slug' => "Slug(URL friendly)",
            'brand_status' => "Status",
        ];
    }
    public function messages()
    {
        return [
            //'required' => ':attribute khong dc de trong!',
            'brand_name.required' => 'Ten hang khong duoc de trong!',
            'brand_slug.required' => 'URL friendly hang khong duoc de trong!',
            'brand_status.required' => 'Vui long chon tinh trang hang!',      
        ];
    }
    public function rules()
    {
        return [
            //
            'brand_name' => 'required',
            'brand_slug' => 'required',
            'brand_status' => 'required',
        ];
    }
}
