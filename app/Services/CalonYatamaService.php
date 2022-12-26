<?php

namespace App\Services;

use App\Http\Requests\StoreCalonYatamaRequest;
use App\Models\CalonYatama;
use Illuminate\Http\Request;

class CalonYatamaService
{

    public function listCalon(Request $request){
        $search = $request->input('tsearch');
        $return = CalonYatama::when($search,function ($query) use ($search){
                    $searchQuery = $query->where('nama', 'like', "%$search%")
                            ->orWhere('gender','like','%'.$search.'%');
                    $lowerSearch = strtolower($search);
                    if(($lowerSearch == 'yatim') OR ($lowerSearch == 'yatim piatu')){
                        $valueNilaiYatim = $lowerSearch == 'yatim' ? true : false;
                        $searchQuery->orWhere('is_yatim', $valueNilaiYatim);
                    }
                    return $searchQuery;
                })->paginate(15);
        $ubah = $return->getCollection()->map(function($item){
            $item['is_yatim'] = $item['is_yatim'] ? 'Yatim' : 'Yatim Piatu';
            $item['gender'] = ucfirst($item['gender']);
            return $item;
        });
        $return->setCollection($ubah);
        return $return;
    }

    public function simpan(StoreCalonYatamaRequest $request)
    {
        $data = $request->validated();
        $calon = $data['anakasuh']; 
        $parents = array_filter($data['orangtua']);
        $pengasuh =  array_filter($data['pengasuh']);
        if($request->hasFile('anakasuh.foto')){
            $fileProfile = $request->file('anakasuh.foto');
            $calon['foto'] = $fileProfile->store('profiles');
        }
        if(count($parents) > 0){
            $calon['data_orangtua'] = json_encode($parents);
        }

        if(count($pengasuh) > 0){
            $calon['data_pengasuh'] = json_encode($pengasuh);
        }
        $calon = CalonYatama::updateOrCreate(['calon_id' => $calon['calon_id']],$calon);
        return $calon;
    }

}
