<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required',
            'username' => 'required|unique:users,username',
            'lang'  => 'required'
        ];
    }

    public function messages()
    {
        return[
            'email.unique'  => __('messages.email.unique'), 
            'email.email'   => __('messages.email.email'),
            'password.required' => __('messages.password.required'),
            'username.unique'  => __('messages.username_unique'),
            'role.required' => __('messages.role.required'),
        ];
    }
}