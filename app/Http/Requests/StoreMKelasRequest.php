<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMKelasRequest extends FormRequest
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
            'kelas_id' => ['nullable', 'integer'],
            'kelas_nama' => ['required', 'max:100'],
            'lulus' => ['nullable']
        ];
    }

    public function attributes()
    {
        return [
            'kelas_nama' => 'Nama Kelas'
        ];
    }
}
