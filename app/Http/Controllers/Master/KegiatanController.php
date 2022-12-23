<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Mkegiatan;
use App\Http\Requests\StoreMkegiatanRequest;
use App\Http\Requests\UpdateMkegiatanRequest;
use App\Services\KegiatanService;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    private KegiatanService $service;

    public function __construct(KegiatanService $serviceParam) {
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
            return $this->service->listKegiatan($request);
        }
        return view('pages.mkegiatan');
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
     * @param  \App\Http\Requests\StoreMkegiatanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMkegiatanRequest $request)
    {
        $kegiatan = $this->service->simpan($request);
        return response()->json([
            'data' => $kegiatan,
            'message' => trans('crud.simpan')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mkegiatan  $mkegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(Mkegiatan $kegiatan)
    {
        return $kegiatan;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mkegiatan  $mkegiatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Mkegiatan $mkegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMkegiatanRequest  $request
     * @param  \App\Models\Mkegiatan  $mkegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMkegiatanRequest $request, Mkegiatan $mkegiatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mkegiatan  $mkegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($kegiatan)
    {
        Mkegiatan::destroy($kegiatan);
        return response()->json([
            'message' => trans('crud.hapusMessage')
        ]);
    }
}
