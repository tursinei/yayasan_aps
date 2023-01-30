<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengeluaranRequest extends FormRequest
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
            'pengeluaran_id'    => 'nullable',
            'tgl'               => 'required',
            'jenis'             => 'nullable',
            'kegiatan_id'       => 'required',
            'program_id'        => 'nullable',
            'keterangan'        => 'nullable|required_without:jenis,santunan',
            'nominal'           => 'required',
            'kurator'           => 'nullable|required_without:jenis,santunan'
        ];
    }

    public function messages()
    {
        return [
            'keterangan.required_without' => 'Kolom <b>Keterangan</b> wajib diisi, jika kegiatan yang dipilih bukan santunan',
            'kurator.required_without' => 'Kolom <b>Kurator</b> wajib diisi, jika kegiatan yang dipilih bukan santunan'
        ];
    }

    public function attributes()
    {
        return [
            'tgl' => 'Tanggal',
            'kegiatan_id' => 'Kegiatan'
        ];
    }
}
