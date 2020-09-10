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
     * @return array
     */
    public function attributes()
    {
        return [
            'product_name' => "Name's Product",
            'product_slug' => "Slug(URL friendly)",
            'product_desc' => "Description",
            'product_content' => "Content",
            'product_status' => "Status",
            'id_category' => "Category",
            'id_brand' => "Brand",
            'product_image' => "Image",
        ];
    }
    public function messages()
    {
        return [
            //'required' => ':attribute khong dc de trong!',
            'product_name.required' => ':attribute khong duoc de trong!',
            'product_slug.required' => ':attribute san pham khong duoc de trong!',
            'product_price.required' => 'Vui long nhap gia san pham!',
            'product_price.numeric' => 'Dinh dang gia san pham vua nhap khong dung!',
            'product_desc.required' => 'Mo ta san pham khong duoc de trong!',
            'product_content.required' => 'Noi dung san pham khong duoc de trong!',
            'product_status.required' => 'Vui long chon tinh trang san pham!',
            'product_image.required' => 'Vui long chon file anh!',
            'product_image.image' => 'Dinh dang file anh khong dung!',         
        ];
    }
    public function rules()
    {
        return [
            //
            'product_name' => 'bail|required',
            'product_slug' => 'bail|required',
            'product_price' => 'bail|required|numeric',
            'product_desc' => 'bail|required',
            'product_content' => 'bail|required',
            'product_status' => 'bail|required',
            'product_image' => 'bail|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
