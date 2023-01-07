<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\MKelas;
use App\Http\Requests\StoreMKelasRequest;
use App\Http\Requests\UpdateMKelasRequest;
use App\Services\KelasService;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    private KelasService $service;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(KelasService $serviceParam)
    {
        $this->service = $serviceParam;
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            return $this->service->listKelas($request);
        }
        return view('pages.mkelas');
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
     * @param  \App\Http\Requests\StoreMKelasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMKelasRequest $request)
    {
        $this->service->simpan($request);
        return response()->json([
            'message' => trans('crud.simpan')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MKelas  $mKelas
     * @return \Illuminate\Http\Response
     */
    public function show(MKelas $kela)
    {
        return $kela;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MKelas  $mKelas
     * @return \Illuminate\Http\Response
     */
    public function edit(MKelas $mKelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMKelasRequest  $request
     * @param  \App\Models\MKelas  $mKelas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMKelasRequest $request, MKelas $mKelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MKelas  $mKelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($kela)
    {
        MKelas::destroy($kela);
        return response()->json([
            'message' => trans('crud.hapusMessage')
        ]);
    }
}
