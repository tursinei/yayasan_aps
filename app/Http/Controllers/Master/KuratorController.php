<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\MKurator;
use App\Http\Requests\StoreMKuratorRequest;
use App\Http\Requests\UpdateMKuratorRequest;
use App\Services\KuratorService;
use Illuminate\Http\Request;

class KuratorController extends Controller
{
    private KuratorService $service;

    public function __construct(KuratorService $serviceParam)
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
            return $this->service->listKurator($request);
        }
        return view('pages.mkurator');
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
     * @param  \App\Http\Requests\StoreMKuratorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMKuratorRequest $request)
    {
        return $this->service->simpan($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MKurator  $mKurator
     * @return \Illuminate\Http\Response
     */
    public function show(MKurator $kurator)
    {
        return $kurator;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MKurator  $mKurator
     * @return \Illuminate\Http\Response
     */
    public function edit(MKurator $mKurator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMKuratorRequest  $request
     * @param  \App\Models\MKurator  $mKurator
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMKuratorRequest $request, MKurator $mKurator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MKurator  $mKurator
     * @return \Illuminate\Http\Response
     */
    public function destroy($kurator)
    {
        MKurator::destroy($kurator);
        return response()->json([
            'message' => trans('crud.hapusMessage')
        ]);
    }
}
