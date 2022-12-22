<?php

namespace App\Http\Controllers;

use App\Models\AnakAsuh;
use App\Http\Requests\StoreAnakAsuhRequest;
use App\Http\Requests\UpdateAnakAsuhRequest;
use App\Services\AnakAsuhService;
use Illuminate\Http\Request;

class AnakAsuhController extends Controller
{

    private AnakAsuhService $service;

    public function __construct(AnakAsuhService $serviceParam) {
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
            return $this->service->listAnakAsuhAktif($request);
        }
        return view('pages.anakasuh');
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
     * @param  \App\Http\Requests\StoreAnakAsuhRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnakAsuhRequest $request)
    {
        $return = $this->service->simpan($request);
        if(!$return){
            return response()->json(['message' => $return],500);
        }
        return response()->json([
            'data' => $return,
            'message' => trans('crud.simpan')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnakAsuh  $anakAsuh
     * @return \Illuminate\Http\Response
     */
    public function show(AnakAsuh $yatama)
    {
        $anak = $yatama;
        return view('modals.anakasuhModal',compact('anak'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnakAsuh  $anakAsuh
     * @return \Illuminate\Http\Response
     */
    public function edit(AnakAsuh $anakAsuh)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAnakAsuhRequest  $request
     * @param  \App\Models\AnakAsuh  $anakAsuh
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnakAsuhRequest $request, AnakAsuh $anakAsuh)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnakAsuh  $anakAsuh
     * @return \Illuminate\Http\Response
     */
    public function destroy($anakAsuh)
    {
        $res = AnakAsuh::destroy($anakAsuh);
        return $res;
    }
}
