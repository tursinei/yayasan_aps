<?php

namespace App\Services;

use App\Http\Requests\StorePendidikanRequest;
use App\Models\AnakAsuh;
use App\Models\MKelas;
use App\Models\Pendidikan;
use Illuminate\Http\Request;

class PendidikanService
{

    public function listKelas()
    {
        return MKelas::orderBy('kelas_nama')->pluck('kelas_nama','kelas_id');
    }

    public function listPendidikan(Request $request){
        $search = $request->input('tsearch');
        $return = Pendidikan::join('anak_asuh','pendidikan.anakasuh_id','=','anak_asuh.anakasuh_id')
                    ->leftJoin('m_kelas','m_kelas.kelas_id','=','pendidikan.kelas_id')
                    ->when($search,function ($query) use ($search){
                    $searchQuery = $query->where('nama', 'like', "%$search%")
                            ->orWhere('jenjang','like','%'.$search.'%')
                            ->orWhere('nama_sekolah','like','%'.$search.'%')
                            ->orWhere('kelas_nama','like','%'.$search.'%')
                            ->orWhere('wali_kelas','like','%'.$search.'%');
                    return $searchQuery;
                })->paginate(15);
        return $return;
    }

    public function simpan(StorePendidikanRequest $request)
    {
        $data = $request->validated();
        $calon = Pendidikan::updateOrCreate(['pendidikan_id' => $data['pendidikan_id']],$data);
        return $calon;
    }

}
