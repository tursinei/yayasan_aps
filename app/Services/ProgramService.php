<?php

namespace App\Services;

use App\Http\Requests\StoreMProgramRequest;
use App\Models\MProgram;
use Illuminate\Http\Request;

class ProgramService
{

    public function listProgram(Request $request){
        $search = $request->input('tsearch');
        $return = MProgram::when($search,
                    fn($query)=>$query->where('program','like','%'.$search.'%')
                )->paginate(15);
        return $return;
    }

    public function simpan(StoreMProgramRequest $request)
    {
        $data = $request->validated();
        $program = MProgram::updateOrCreate(['program_id' => $data['program_id']], $data);
        return $program;
    }

}
