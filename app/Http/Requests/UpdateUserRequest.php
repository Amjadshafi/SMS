<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Builder\Function_;

class UpdateUserRequest extends FormRequest
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
        // Let's get the route param by name to get the User object value
        $user = request()->route('user');

        return [
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email,'.$user->id,
            'username' => 'required|unique:users,username,'.$user->id,
            'lang'  => 'required',
            'config' => '',
        ];
    }
    public function messages()
    {
        return [
            'username_unique' => __('messages.username_unique'),
            'email.unique'  => __('messages.email.unique'), 
            'email.email'   => __('messages.email.email'),
            'password.required' => __('messages.password.required'),
            'config'  => __('messages.config'),
        ];
    }
}