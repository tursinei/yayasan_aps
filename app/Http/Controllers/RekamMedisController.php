<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Http\Requests\StoreRekamMedisRequest;
use App\Services\AnakAsuhService;
use App\Services\RekamMedisService;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    private RekamMedisService $service;

    public function __construct(RekamMedisService $serviceParam)
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
            return $this->service->listRekamMedik($request);
        }
        $anakService = new AnakAsuhService();
        $listAnak = $anakService->listNamaAnakAktif();
        return view('pages.rekammedis',compact('listAnak'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $anakasuh_id = $request->input('id');
        return view('modals.rekamMedisModal',compact('anakasuh_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRekamMedisRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRekamMedisRequest $request)
    {
        $this->service->simpan($request);
        return response()->json([
            'message' => trans('crud.simpan')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RekamMedis  $rekamMedis
     * @return \Illuminate\Http\Response
     */
    public function show(RekamMedis $rekammedi)
    {
        $rekam = $rekammedi;
        $anakasuh_id = $rekam->anakasuh_id;
        return view('modals.rekamMedisModal',compact('rekam','anakasuh_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RekamMedis  $rekamMedis
     * @return \Illuminate\Http\Response
     */
    public function edit(RekamMedis $rekamMedis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRekamMedisRequest  $request
     * @param  \App\Models\RekamMedis  $rekamMedis
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRekamMedisRequest $request, RekamMedis $rekamMedis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $rekamMedis
     * @return \Illuminate\Http\Response
     */
    public function destroy($rekammedi)
    {
        RekamMedis::destroy($rekammedi);
        return response()->json([
            'message' => trans('crud.hapusMessage')
        ]);
    }
}
