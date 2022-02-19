<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if ($this->getMethod() == 'patch') {
            return [
                'first_name' => 'bail|required|min:2',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'role' => 'required'
            ];
        } else {
            return [
                'first_name' => 'bail|required|min:2',
                'email' => 'required|email|unique:users,email,' . $this->id,
                'password' => 'required|min:6',
                'role' => 'required'
            ];
        }
    }
}
