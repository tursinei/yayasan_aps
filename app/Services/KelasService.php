<?php

namespace App\Services;

use App\Http\Requests\StoreMKelasRequest;
use App\Models\MKelas;
use Illuminate\Http\Request;

class KelasService
{

    public function listKelas(Request $request){
        $search = $request->input('tsearch');
        $return = MKelas::when($search,
                    fn($query)=>$query->where('kelas_nama','like','%'.$search.'%')
                )->orderBy('kelas_nama')->paginate(15);
        return $return;
    }

    public function simpan(StoreMKelasRequest $request)
    {
        $data = $request->validated();
        $data['lulus'] = $data['lulus']??0;
        $kegiatan = MKelas::updateOrCreate(['kelas_id' => $data['kelas_id']], $data);
        return $kegiatan;
    }

}
