<?php

namespace App\Services;

use App\Http\Requests\StoreRabRequest;
use App\Models\Rab;
use Illuminate\Http\Request;

class RabService
{

    public function listRab(Request $request){
        $search = $request->input('tsearch');
        $thn = $request->input('thn');
        $return = Rab::join('m_program','m_program.program_id','=','rab.program_id')->where('tahun',$thn)
                ->when($search,function($query) use($search){
                    return $query->where('uraian', 'like', "%$search%")
                            ->orWhere('program','like','%'.$search.'%');
                })->orderBy('rab.created_at','ASC')->paginate(15);
        return $return;
    }

    public function simpan(StoreRabRequest $request)
    {
        $data = $request->validated();
        $rab = Rab::updateOrCreate(['rab_id' => $data['rab_id']], $data);
        return $rab;
    }

}
