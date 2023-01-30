<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Pengeluaran;
use App\Http\Requests\StorePengeluaranRequest;
use App\Http\Requests\UpdatePengeluaranRequest;
use App\Models\MKegiatan;
use App\Models\MProgram;
use App\Services\KasService;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    private KasService $service;

    public function __construct(KasService $serviceParam)
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
            return $this->service->listPengeluaran($request);
        }
        return view('pages.pengeluaran');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kegiatans  = MKegiatan::orderBy('kegiatan_id')->get();
        $programs    = MProgram::orderBy('program')->pluck('program','program_id');
        return view('modals.pengeluaranModal', compact('kegiatans', 'programs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePengeluaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengeluaranRequest $request)
    {
        $data = $this->service->simpanPengeluaran($request);
        return Helper::setResponse(trans('crud.simpan'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pengeluaran $pengeluaran)
    {
        $kegiatans  = MKegiatan::orderBy('kegiatan_id')->get();
        $programs    = MProgram::orderBy('program')->pluck('program','program_id');
        return view('modals.pengeluaranModal', compact('kegiatans', 'programs', 'pengeluaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePengeluaranRequest  $request
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePengeluaranRequest $request, Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($pengeluaran)
    {
        Pengeluaran::destroy($pengeluaran);
        return Helper::setResponse(trans('crud.hapusMessage'));
    }
}
