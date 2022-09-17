<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'name' => 'required|max:50|unique:product_categories',
                    'cover' => 'required|mimes:jpg,jpeg,png|max:2000',
                    'status' => 'required',
                    'parent_id' => 'nullable',
                ];
            }
            case 'PUT':
            case 'Patch':
            {
                return [
                    'name' => 'required|max:50|unique:product_categories,name,' . $this->route()->product_category->id,
                    'cover' => 'required|mimes:jpg,jpeg,png|max:2000',
                    'status' => 'required',
                    'parent_id' => 'nullable',
                ];

            }
            default: break;

        }
    }
}
