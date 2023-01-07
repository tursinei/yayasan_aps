<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class   StorePendidikanRequest extends FormRequest
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
            'pendidikan_id' => ['nullable'],
            'anakasuh_id' => ['required'],
            'jenjang'       => ['required','max:10', 'string'],
            'nama_sekolah'  => ['required','max:250', 'string'],
            'kelas_id'      => ['required'],
            'wali_kelas'    => ['required','max:100', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'anakasuh_id' => 'Nama',
            'nama_sekolah' => 'Nama Sekolah',
            'wali_kelas' => 'Wali Kelas',
            'kelas_id'  => 'Kelas'
        ];
    }
}
