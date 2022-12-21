<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsersRequest extends FormRequest
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
            'name'      => ['required','string','max:255'],
            'email'  => ['required', 'string','max:255'],
            'password'  => ['required_without:id','confirmed'],
            'peran'     => ['required','between:0,6']
        ];
    }

    public function messages()
    {
        return [
            'password.required_without' => 'Password Field required'
        ];
    }
}
