<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePemasukanRequest extends FormRequest
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
            'pemasukan_id'  => ['nullable','integer'],
            'tgl'           => ['required'],
            'is_donasi'     => ['required'],
            'kategori_lain' => ['required_if:is_donasi,0'],
            'nama_donatur'  => ['nullable'],
            'keterangan'    => ['nullable'],
            'nominal'       => ['required'],
            'kurator_id'    => ['nullable','integer']

        ];
    }

    public function attributes()
    {
        return [
            'tgl'           => 'Tanggal Pemasukan',
            'is_donasi'     => 'Kategori donasi',
            'nama_donatur'  => 'Nama Donatur'
        ];
    }

    public function messages()
    {
        return [
            'kategori_lain.required_if' => 'Nama Kategori Pemasukan Lain wajib diisi'
        ];
    }
}
