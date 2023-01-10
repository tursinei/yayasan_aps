<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRekamMedisRequest extends FormRequest
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
            'rekam_medis_id' => ['nullable'],
            'tgl_periksa'   => ['required','date'],
            'keluhan'       => ['required'],
            'diagnosa'      => ['required'],
            'obat'          => ['nullable'],
            'keterangan'    => ['nullable','max:100'],
            'anakasuh_id'   => ['required']
        ];
    }

    public function attributes()
    {
        return [
            'tgl_periksa'   => 'Tanggal Periksa',
            'keluhan'       => 'Keluhan',
            'diagnosa'      => 'Diagnosa',
            'obat'          => 'Obat / Penanganan',
            'anakasuh_id'   => 'Yatama'
        ];
    }
}
