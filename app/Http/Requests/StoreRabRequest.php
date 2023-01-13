<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRabRequest extends FormRequest
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
            'rab_id'    => 'nullable|integer',
            'uraian'    => 'nullable|max:220',
            'nominal'   => 'required|numeric',
            'tahun'     => 'required|numeric',
            'program_id'  => 'required|numeric'
        ];
    }

    public function attributes()
    {
        return [
            'rab_id'    => 'ID RAB',
        ];
    }
}
