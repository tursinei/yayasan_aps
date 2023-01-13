<?php

namespace App\Http\Controllers;

use App\Models\Rab;
use App\Http\Requests\StoreRabRequest;
use App\Http\Requests\UpdateRabRequest;
use App\Models\MProgram;
use App\Services\RabService;
use Illuminate\Http\Request;

class RabController extends Controller
{
    private RabService $service;

    public function __construct(RabService $serviceParam)
    {
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
            return $this->service->listRab($request);
        }
        return view('pages.rab');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $thn = $request->input('thn');
        $programs = MProgram::orderBy('program')->pluck('program','program_id');
        return view('modals.rabModal', compact('thn', 'programs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRabRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRabRequest $request)
    {
        $request = $this->service->simpan($request);
        return response()->json([
            'message' => trans('crud.simpan')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rab  $rab
     * @return \Illuminate\Http\Response
     */
    public function show(Rab $rab)
    {
        $thn = $rab->tahun;
        $programs = MProgram::orderBy('program')->pluck('program','program_id');
        return view('modals.rabModal', compact('thn', 'programs', 'rab'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rab  $rab
     * @return \Illuminate\Http\Response
     */
    public function edit(Rab $rab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRabRequest  $request
     * @param  \App\Models\Rab  $rab
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRabRequest $request, Rab $rab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $rab
     * @return \Illuminate\Http\Response
     */
    public function destroy($rab)
    {
        Rab::destroy($rab);
        return response()->json([
            'message' => trans('crud.hapusMessage')
        ]);
    }
}
