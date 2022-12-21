<?php

namespace App\Services;

use App\Http\Requests\StoreAnakAsuhRequest;
use App\Models\AnakAsuh;
use App\Models\Kordes;
use App\Models\Parents;
use App\Models\Pengasuh;

class AnakAsuhService
{

    public function listAnakAsuhAktif(){
        $return = AnakAsuh::select('anakasuh_id','nama','gender','tgl_lahir','is_yatim', 'anak_ke', 'tgl_masuk')
                ->where('is_alumni',false)->paginate(10);
        $ubah = $return->getCollection()->map(function($item){
            $item['is_yatim'] = $item['is_yatim'] ? 'Yatim' : 'Yatim Piatu';
            $item['gender'] = ucfirst($item['gender']);
            return $item;
        });
        $return->setCollection($ubah);
        return $return;
    }

    public function simpan(StoreAnakAsuhRequest $request)
    {
        $data = $request->validated();
        $anak = $data['anakasuh'];
        $anakAsuh = AnakAsuh::updateOrCreate(['anakasuh_id' => $anak['anakasuh_id']],$anak);
        if($request->hasFile('anakasuh.foto')){
            $fileProfile = $request->file('anakasuh.foto');
            $nameUploaded = $anakAsuh->anakasuh_id.'.'.$fileProfile->extension();
            $anakAsuh->foto = $fileProfile->storeAs('profiles',$nameUploaded);
            $anakAsuh->save();
        }
        $parents_id  = $data['orangtua']['parent_id'];
        $pengasuh_id = $data['pengasuh']['pengasuh_id'];
        $kordes_id   = $data['kordes']['kordes_id'];
        $parents = array_filter($data['orangtua']);
        $pengasuh =  array_filter($data['pengasuh']);
        $kordes =  array_filter($data['kordes']);
        if(count($parents) > 0){
            $parents['anakasuh_id'] = $anakAsuh->anakasuh_id;
            Parents::updateOrCreate(['parent_id' => $parents_id], $parents);
        }
        if(count($pengasuh) > 0){
            $pengasuh['anakasuh_id'] = $anakAsuh->anakasuh_id;
            Pengasuh::updateOrCreate(['pengasuhid' => $pengasuh_id], $pengasuh);
        }
        if(count($kordes)){
            $kordes['anakasuh_id'] = $anakAsuh->anakasuh_id;
            Kordes::updateOrCreate(['kordes_id' => $kordes_id], $kordes);
        }

        return $anakAsuh;
    }

}
