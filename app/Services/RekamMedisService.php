<?php

namespace App\Services;

use App\Http\Requests\StoreMKelasRequest;
use App\Http\Requests\StoreRekamMedisRequest;
use App\Models\MKelas;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class RekamMedisService
{

    public function listRekamMedik(Request $request){
        $search = $request->input('tsearch');
        $id = $request->input('id');
        $return = RekamMedis::when($search,function($query) use ($search){
            $searchQuery = $query->where('diagnosa', 'like', "%$search%")
                            ->orWhere('keluhan','like','%'.$search.'%')
                            ->orWhere('obat','like','%'.$search.'%')
                            ->orWhere('keterangan','like','%'.$search.'%');
            return $searchQuery;
        })->where('anakasuh_id',$id)->orderBy('tgl_periksa','DESC')->paginate(15);
        return $return;
    }

    public function simpan(StoreRekamMedisRequest $request)
    {
        $data = $request->validated();
        $rekamMedis = RekamMedis::updateOrCreate(['rekam_medis_id' => $data['rekam_medis_id']], $data);
        return $rekamMedis;
    }

}
