<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Pemasukan;
use App\Http\Requests\StorePemasukanRequest;
use App\Models\MKurator;
use App\Services\KasService;
use Illuminate\Http\Request;

class PemasukanController extends Controller
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
            return $this->service->listPemasukan($request);
        }
        return view('pages.pemasukan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kurator = MKurator::orderBy('nama')->pluck('nama','kurator_id');
        return view('modals.pemasukanModal', compact('kurator'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePemasukanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePemasukanRequest $request)
    {
        $this->service->simpanPemasukan($request);
        return Helper::setResponse(trans('crud.simpan'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function show(Pemasukan $pemasukan)
    {
        $kurator = MKurator::orderBy('nama')->pluck('nama','kurator_id');
        return view('modals.pemasukanModal', compact('kurator','pemasukan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemasukan $pemasukan)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function destroy($pemasukan)
    {
        Pemasukan::destroy($pemasukan);
        return Helper::setResponse(trans('crud.hapusMessage'));
    }
}
