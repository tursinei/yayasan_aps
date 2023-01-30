<?php

namespace App\Services;

use App\Http\Requests\StorePemasukanRequest;
use App\Http\Requests\StorePengeluaranRequest;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
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

    public function listPengeluaran(Request $request){
        $search = $request->input('tsearch');
        $return = Pengeluaran::join('m_kegiatan AS keg', 'pengeluaran.kegiatan_id','=','keg.kegiatan_id')
                ->leftJoin('m_program AS prog', 'pengeluaran.program_id','=','prog.program_id')
                ->when($search,function($query) use($search){
                    $lower = strtolower($search);
                    $nominalSearch = abs($search) ?? 0;
                    $sQuery = $query->whereRaw('LOWER(program) like "%?%"', [$lower])
                            ->orWhereRaw('LOWER(kegiatan) like "%?%"', [$lower])
                            ->orWhereRaw('LOWER(keterangan) like "%?%"', [$lower])
                            ->orWhere('nominal','=',$nominalSearch);
                    return $sQuery;
                })->orderBy('tgl','DESC')->paginate(15);
        $return->getCollection()->map(function($item){
            $item['nominal'] =  number_format($item['nominal'],0,',','.');
            return $item;
        });
        return $return;
    }

    public function simpanPengeluaran(StorePengeluaranRequest $request)
    {
        $data = $request->validated();
        $data['nominal'] = str_replace('.','',$data['nominal']);
        $data = Pengeluaran::updateOrCreate(['pengeluaran_id' => $data['pengeluaran_id']], $data);
        return $data;
    }

}
