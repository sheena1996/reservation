<?php

namespace App\Http\Requests;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
        $productID = $this->route()->parameter('product');

        $rules = [
            'name'     => 'required|string|max:255|unique:products,name,'.$productID,
            'sku'      => 'required|string|max:255',
            'cost'     => 'required|numeric',
        ];
        return $rules;


    }
    public function filters()
    {
        return [
            'name' => 'trim|lowercase',
            'sku' => 'trim|uppercase|escape'
        ];
    }
}
