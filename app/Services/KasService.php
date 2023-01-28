<?php

namespace App\Services;

use App\Http\Requests\StorePemasukanRequest;
use App\Models\Pemasukan;
use App\Models\Rab;
use Illuminate\Http\Request;

class KasService
{

    public function listPemasukan(Request $request){
        $search = $request->input('tsearch');
        $return = Pemasukan::when($search,function($query) use($search){
                    $lower = strtolower($search);
                    $nominalSearch = abs($search) ?? 0;
                    $sQuery = $query->whereRaw('LOWER(kategori_lain) like "%?%"', [$lower])
                            ->orWhereRaw('LOWER(nama_donatur) like "%?%"', [$lower])
                            ->orWhereRaw('LOWER(keterangan) like "%?%"', [$lower])
                            ->orWhere('nominal','=',$nominalSearch);
                    if($lower == 'donasi' || $lower == 'lainnya'){
                        $valueIsDonasi = $lower == 'donas' ? true : false;
                        $sQuery->orWhere('is_donasi',$valueIsDonasi);
                    }
                    return $sQuery;
                })->orderBy('tgl','DESC')->paginate(15);
        $ubah = $return->getCollection()->map(function($item){
            $item['kategori'] = $item['is_donasi'] ? 'Donasi' : 'Lainnya';
            $item['nominal'] =  number_format($item['nominal'],0,',','.');
            $item['donatur_lainnya'] = $item['is_donasi'] ? $item['nama_donatur'] :$item['kategori_lain'];
            return $item;
        });
        $return->setCollection($ubah);
        return $return;
    }

    public function simpanPemasukan(StorePemasukanRequest $request)
    {
        $data = $request->validated();
        $data['nama_donatur'] = $data['nama_donatur'] ?? 'Hamba Dermawan';
        $data['nominal'] = str_replace('.','',$data['nominal']);
        if(!$data['is_donasi']){
            $data['nama_donatur'] = '';
        } else {
            $data['kategori_lain'] = '';
        }
        $data = Pemasukan::updateOrCreate(['pemasukan_id' => $data['pemasukan_id']], $data);
        return $data;
    }

}
