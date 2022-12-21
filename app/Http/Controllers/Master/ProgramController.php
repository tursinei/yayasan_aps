<?php

namespace App\Http\Controllers\Master;

use App\Models\MProgram;
use App\Http\Requests\StoreMProgramRequest;
use App\Http\Requests\UpdateMProgramRequest;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreMProgramRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMProgramRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MProgram  $mProgram
     * @return \Illuminate\Http\Response
     */
    public function show(MProgram $mProgram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MProgram  $mProgram
     * @return \Illuminate\Http\Response
     */
    public function edit(MProgram $mProgram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMProgramRequest  $request
     * @param  \App\Models\MProgram  $mProgram
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMProgramRequest $request, MProgram $mProgram)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MProgram  $mProgram
     * @return \Illuminate\Http\Response
     */
    public function destroy(MProgram $mProgram)
    {
        //
    }
}
