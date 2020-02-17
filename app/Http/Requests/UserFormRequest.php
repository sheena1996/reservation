<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
        /*
        * When a user model has been resolved will be ignored by the "unique" rule.
        * The "bypass" variable is automatically converted to the model primary key value.
        */
        $bypass = $this->user->id ?? "";
        
        if( $request->has(['first_name', 'last_name','address','contact_number']) ) {

            $rules = [
                'first_name'     => 'required|string|max:255',
                'last_name'      => 'required|string|max:255',
                'address'        => 'required|string|max:255',
                'contact_number' => 'required|string|max:255',
            ];

            if ($request->filled(['email'])) 
            {
                $rules += [
                    'email'        => 'required|string|email|max:255|unique:users,email,'.$bypass,
                ];
            }

            if ($request->filled(['password'])) 
            {
                $rules += [
                    'password' => 'required|min:8|confirmed',
                ];
            } 
           
        } else {
    
            $rules = [ 
                'email'        => 'required|string|email|max:255|unique:users,email,'.$bypass,
            ];

            if ($request->filled(['password'])) 
            {
                $rules += [
                    'password' => 'required|min:8|confirmed',
                ];
            }
                      
        }

        // dd($rules);
        return $rules;
    }

     /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'email' => 'trim|lowercase',
            'name' => 'trim|capitalize|escape'
        ];
    }
}
