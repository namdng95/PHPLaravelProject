<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'category_name' => "Name's Category",
            'category_slug' => "Slug(URL friendly)",
            'category_status' => "Status",
        ];
    }
    public function messages()
    {
        return [
            //'required' => ':attribute khong dc de trong!',
            'category_name.required' => 'Ten danh muc khong duoc de trong!',
            'category_slug.required' => 'Slug (URL friendly) danh muc khong duoc de trong!',
            'category_status.required' => 'Vui long chon tinh trang danh muc!',      
        ];
    }
    public function rules()
    {
        return [
            //
            'category_name' => 'required',
            'category_slug' => 'required',
            'category_status' => 'required',
        ];
    }
}
