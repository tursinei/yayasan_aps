<?php

namespace App\Services;

use App\Models\AnakAsuh;
use App\Models\CalonYatama;
use App\Models\Parents;
use App\Models\Pengasuh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class VerifikasiService
{

    public function listVerifikasi(Request $request){
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
                })->where('status','<>',2)->paginate(15);
        $ubah = $return->getCollection()->map(function($item){
            $item['is_yatim'] = $item['is_yatim'] ? 'Yatim' : 'Yatim Piatu';
            $item['gender'] = ucfirst($item['gender']);
            return $item;
        });
        $return->setCollection($ubah);
        return $return;
    }

    public function validasi(Request $request)
    {
        $data = $request->validate([
            'calon_id' => 'required',
            'status' => 'required',
            'alasan_tolak' => 'required_if:status,1'
        ]);
        if($data['status'] == 2){
            // copy model ke yatama, parents danpengsuh
            $calon      = CalonYatama::find($data['calon_id']);
            $parent     = json_decode($calon->data_orangtua,true);
            $pengasuh   = json_decode($calon->data_pengasuh, true);
            $foto = $calon->foto;
            $offsetKey = ['data_orangtua','data_pengasuh','tgl_validasi','daftar_oleh','status','alasan_tolak','foto', 'updated_at'];
            $yatamaNew = AnakAsuh::create($calon->replicate($offsetKey)->toArray());
            $parent['anakasuh_id'] = $yatamaNew->anakasuh_id;
            $pengasuh['anakasuh_id'] = $yatamaNew->anakasuh_id;
            Parents::create($parent);
            Pengasuh::create($pengasuh);
            $fotoPath  = Storage::path($foto);
            if(file_exists($fotoPath)){
                $extention = pathinfo($fotoPath, PATHINFO_EXTENSION);
                $newFile = Storage::path('profiles/'.$yatamaNew->anakasuh_id.'.'.$extention);
                File::move($fotoPath,$newFile);
            }
        }
        $calon = CalonYatama::where('calon_id', $data['calon_id'])
                            ->update($data);
        return $calon;
    }

}
