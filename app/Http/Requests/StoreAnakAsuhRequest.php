<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnakAsuhRequest extends FormRequest
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
            'anakasuh.anakasuh_id'   => ['nullable','integer'],
            'anakasuh.nama'          => ['required','max:250'],
            'anakasuh.tempat_lahir'  => ['required','string','max:225'],
            'anakasuh.tgl_lahir'     => ['required','date'],
            'anakasuh.gender'        => ['nullable','string'],
            'anakasuh.anak_ke'       => ['nullable','numeric'],
            'anakasuh.is_yatim'      => ['nullable','boolean'],
            'anakasuh.is_sebelum_yatim' => ['boolean','nullable'],
            'anakasuh.yatim_umur'    => ['nullable','integer'],
            'anakasuh.foto'          =>['nullable','mimes:png,jpg,jpeg'],
            'orangtua.parent_id'     => ['nullable','integer'],
            'orangtua.nama'          => ['nullable','string','max:250'],
            'orangtua.pekerjaan'     => ['nullable','string','max:250'],
            'orangtua.alamat'        => ['nullable','string','max:250'],
            'pengasuh.pengasuh_id'   => ['nullable','integer'],
            'pengasuh.nama'          => ['nullable','string','max:250'],
            'pengasuh.pekerjaan'     => ['nullable','string','max:250'],
            'pengasuh.alamat'        => ['nullable','string','max:250'],
            'kordes.kordes_id'       => ['nullable','integer'],
            'kordes.nama'            => ['nullable','string','max:250'],
            'kordes.tahun'           => ['nullable','integer','min:2000', 'nullable']
        ];
    }

    public function messages()
    {
        return [
            'anakasuh.nama.required' => 'Nama Yatama Wajib Disi',
            'anakasuh.tempat_lahir.required' => 'Tempat Lahir Yatama Wajib Disi',
            'anakasuh.nama.required' => 'Tanggal Yatama Wajib Disi',
        ];
    }
}
