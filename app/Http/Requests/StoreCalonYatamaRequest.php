<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCalonYatamaRequest extends FormRequest
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
            'anakasuh.calon_id'   => ['nullable','integer'],
            'anakasuh.nama'          => ['required','max:250'],
            'anakasuh.tempat_lahir'  => ['required','string','max:225'],
            'anakasuh.tgl_lahir'     => ['required','date'],
            'anakasuh.gender'        => ['required','string'],
            'anakasuh.is_yatim'      => ['required','boolean'],
            'anakasuh.is_sebelum_yatim' => ['required','boolean'],
            'anakasuh.yatim_umur'    => ['nullable','integer'],
            'anakasuh.anak_ke'       => ['nullable','numeric'],
            'anakasuh.foto'          => ['nullable','mimes:png,jpg,jpeg'],
            'orangtua.parent_id'     => ['nullable','integer'],
            'orangtua.nama'          => ['nullable','string','max:250'],
            'orangtua.pekerjaan'     => ['nullable','string','max:250'],
            'orangtua.alamat'        => ['nullable','string','max:250'],
            'pengasuh.pengasuh_id'   => ['nullable','integer'],
            'pengasuh.nama'          => ['nullable','string','max:250'],
            'pengasuh.pekerjaan'     => ['nullable','string','max:250'],
            'pengasuh.alamat'        => ['nullable','string','max:250'],
            'anakasuh.user_id'       => ['nullable','integer'],
            'anakasuh.tgl_masuk'     => ['required','date']
        ];
    }

    public function messages()
    {
        return [
            'anakasuh.nama.required' => 'Nama Yatama Wajib Disi',
            'anakasuh.tempat_lahir.required' => 'Tempat Lahir Yatama Wajib Disi',
            'anakasuh.nama.required' => 'Tanggal Yatama Wajib Disi',
            'anakasuh.gender.required' => 'Jenis Kelamin Wajib Diisi',
            'anakasuh.is_yatim.required' => 'Status anak wajib ditentukan',
            'anakasuh.is_sebelum_yatim.required' => 'Status yatim wajib ditentukan',
            'anakasuh.tgl_masuk.required' => 'Tanggal Masuk Yatama wajib diisi',
        ];
    }
}
