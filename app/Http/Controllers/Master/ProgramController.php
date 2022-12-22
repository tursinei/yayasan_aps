<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\MProgram;
use App\Http\Requests\StoreMProgramRequest;
use App\Http\Requests\UpdateMProgramRequest;
use App\Services\ProgramService;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    private ProgramService $service;

    public function __construct(ProgramService $serviceParam) {
        $this->service = $serviceParam;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return $this->service->listProgram($request);
        }
        return view('pages.mprogram');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMProgramRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMProgramRequest $request)
    {
        $program = $this->service->simpan($request);
        return response()->json([
            'data' => $program,
            'message' => trans('crud.simpan')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MProgram  $mProgram
     * @return \Illuminate\Http\Response
     */
    public function show(MProgram $program)
    {
        return $program;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MProgram  $mProgram
     * @return \Illuminate\Http\Response
     */
    public function edit(MProgram $mProgram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMProgramRequest  $request
     * @param  \App\Models\MProgram  $mProgram
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMProgramRequest $request, MProgram $mProgram)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MProgram  $mProgram
     * @return \Illuminate\Http\Response
     */
    public function destroy($program)
    {
        $del = MProgram::destroy($program);
        return response()->json([
            'message' => trans('crud.hapusMessage')
        ]);
    }
}
