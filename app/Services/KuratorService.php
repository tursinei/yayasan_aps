<?php

namespace App\Services;

use App\Http\Requests\StoreMkegiatanRequest;
use App\Http\Requests\StoreMKuratorRequest;
use App\Models\MKegiatan;
use App\Models\MKurator;
use Illuminate\Http\Request;

class KuratorService
{

    public function listKurator(Request $request){
        $search = $request->input('tsearch');
        $return = MKurator::when($search,
                    fn($query)=>$query->where('nama','like','%'.$search.'%')
                )->paginate(15);
        return $return;
    }

    public function simpan(StoreMKuratorRequest $request)
    {
        $data = $request->validated();
        $kurator = MKurator::updateOrCreate(['kurator_id' => $data['kurator_id']], $data);
        return $kurator;
    }

}
