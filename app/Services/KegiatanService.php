<?php

namespace App\Services;

use App\Http\Requests\StoreMkegiatanRequest;
use App\Models\MKegiatan;
use Illuminate\Http\Request;

class KegiatanService
{

    public function listKegiatan(Request $request){
        $search = $request->input('tsearch');
        $return = MKegiatan::when($search,
                    fn($query)=>$query->where('kegiatan','like','%'.$search.'%')
                )->paginate(15);        // $ubah =
        $return->getCollection($return)->map(function($item){
            $item['santunan'] = $item['bukan_santunan'] ? 'Bukan santunan' : 'Santunan';
        });
        return $return;
    }

    public function simpan(StoreMkegiatanRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        $kegiatan = MKegiatan::updateOrCreate(['kegiatan_id' => $data['kegiatan_id']], $data);
        return $kegiatan;
    }

}
