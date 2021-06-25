<?php

namespace App\Http\Requests;

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
        $rules['product_name'] = ['required','string','unique:products,product_name'];
        $rules['product_code'] = ['required','string','unique:products,product_code'];
        //update ar somoy
        if($this->getMethod() == 'PUT')
        {
            $rules['product_name'][2] = 'unique:products,product_name,'.$this->route('product');
            $rules['product_code'][2] = 'unique:products,product_code,'.$this->route('product');
        }

/*******
 * For Custom Rule
 *      $rules['product_name'] = ['required','string','unique:products,product_name',new Uppercase()];
 *      $rules['product_code'] = ['required','string','unique:products,product_code',new Coderule()];
 * 
 *      if($this->getMethod() == 'POST')
        {
            $rules['product_name'][2] = 'unique:products,product_name,'.request()->id;
            $rules['product_code'][2] = 'unique:products,product_code,'.request()->id;
        }
 * 
 *      //Route Checking 
 *      if(Route::has('register'))
 *      if($request->routeIs('register'))
 * 
 *      'email'=>'required|email|exists:admins,email',
 *      'email.exists'=>'This email is not exists in admins table'
 * 
 * *******/


        $rules['brand_id']     = ['required','integer'];
        $rules['category_id']  = ['required','integer'];
        $rules['price']        = ['required','numeric','gt:0'];
        $rules['qty']          = ['required','numeric','gt:0'];
        $rules['min_qty']      = ['required','numeric','min:1'];
        $rules['max_qty']      = ['required','numeric','gte:min_qty'];

        return $rules;
    }

    public function messages()
    {
        return [
            'brand_id.required'     => 'The brand name field is required.',
            'brand_id.integer'      => 'The brand name field value must be integer.',
            'category_id.required'  => 'The category name field is required.',
            'category_id.integer'   => 'The category name field value must be integer.',
            'qty.required'          => 'The quantity field is required.',
            'qty.gt'                => 'The quantity field value must be greater than zero.',
            'qty.numeric'           => 'The quantity field value must be numeric',
        ];
    }
}
