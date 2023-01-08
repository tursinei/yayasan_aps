<?php

namespace App\Http\Controllers;

use App\Models\Pendidikan;
use App\Http\Requests\StorePendidikanRequest;
use App\Services\AnakAsuhService;
use App\Services\PendidikanService;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    private PendidikanService $service;

    public function __construct(PendidikanService $serviceParam)
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
            return $this->service->listPendidikan($request);
        }
        return view('pages.pendidikan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anakService = new AnakAsuhService();
        $listAnak = $anakService->listNamaAnakAktif();
        $listKelas = $this->service->listKelas();
        return view('modals.pendidikanModal', compact('listAnak','listKelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePendidikanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePendidikanRequest $request)
    {
        $this->service->simpan($request);
        return response()->json([
            'message' => trans('crud.simpan')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pendidikan  $Pendidikan
     * @return \Illuminate\Http\Response
     */
    public function show(Pendidikan $pendidikan)
    {
        $anakService = new AnakAsuhService();
        $listAnak = $anakService->listNamaAnakAktif();
        $listKelas = $this->service->listKelas();
        return view('modals.pendidikanModal',compact('pendidikan','listAnak','listKelas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pendidikan  $Pendidikan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendidikan $Pendidikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePendidikanRequest  $request
     * @param  \App\Models\Pendidikan  $Pendidikan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePendidikanRequest $request, Pendidikan $Pendidikan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $Pendidikan
     * @return \Illuminate\Http\Response
     */
    public function destroy($pendidikan)
    {
        Pendidikan::destroy($pendidikan);
        return response()->json([
            'message' => trans('crud.hapusMessage')
        ]);
    }
}
