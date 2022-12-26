<?php

namespace App\Http\Controllers;

use App\Models\CalonYatama;
use App\Http\Requests\StoreCalonYatamaRequest;
use App\Http\Requests\UpdateCalonYatamaRequest;
use App\Services\CalonYatamaService;
use Illuminate\Http\Request;

class CalonYatamaController extends Controller
{

    private CalonYatamaService $service;

    public function __construct(CalonYatamaService $serviceParam)
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
            return $this->service->listCalon($request);
        }
        return view('pages.calonanakasuh');
    }

    public function pendaftaran()
    {
        return view('pages.pendaftaran');
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
     * @param  \App\Http\Requests\StoreCalonYatamaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCalonYatamaRequest $request)
    {
        $calon = $this->service->simpan($request);
        return response()->json([
            'data' => $calon,
            'message' => trans('crud.simpan')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CalonYatama  $calonYatama
     * @return \Illuminate\Http\Response
     */
    public function show(CalonYatama $calonyatama)
    {
        $anak = $calonyatama;
        $anak->parent = json_decode($anak->data_orangtua);
        $anak->pengasuh = json_decode($anak->data_pengasuh);
        return view('modals.anakasuhModal',compact('anak'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CalonYatama  $calonYatama
     * @return \Illuminate\Http\Response
     */
    public function edit(CalonYatama $calonyatama)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCalonYatamaRequest  $request
     * @param  \App\Models\CalonYatama  $calonYatama
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCalonYatamaRequest $request, CalonYatama $calonYatama)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CalonYatama  $calonYatama
     * @return \Illuminate\Http\Response
     */
    public function destroy($calonyatama)
    {
        $res = CalonYatama::destroy($calonyatama);
        return $res;
    }
}
