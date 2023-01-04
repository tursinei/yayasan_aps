<?php

namespace App\Http\Controllers;

use App\Models\CalonYatama;
use App\Services\VerifikasiService;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{

    private VerifikasiService $service;

    function __construct(VerifikasiService $serviceParam)
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
            return $this->service->listVerifikasi($request);
        }
        return view('pages.verifikasi-yatama');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->service->validasi($request);
        return response()->json([
            'message' => 'Data Calon yatama telah dikonfirmsi'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  CalonYatama $id
     * @return \Illuminate\Http\Response
     */
    public function show(CalonYatama $verifikasi)
    {
        $anak = $verifikasi;
        $anak->parent = json_decode($anak->data_orangtua);
        $anak->pengasuh = json_decode($anak->data_pengasuh);
        return view('modals.verifikasiModal',compact('anak'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
