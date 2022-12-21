@extends('layouts.modal',['modalTitle' => 'Ubah data Yatama', 'idForm' => 'fo-yatama', 'isLarge' => true])

@section('ModalBody')
@php
    $options = ['class' => 'form-control input-sm'];
    // dd($anak);
@endphp
<div class="form-horizontal" role="form">
    <div class="form-body">
        <fieldset>
            <legend>Data Pribadi</legend>
            @php
                $urlProfile = asset('img/user.png');
                if(!empty($anak->foto)){
                    $urlProfile = asset($anak->foto);
                }
            @endphp
            <div class="col-md-3 pull-right text-center">
                <img class="image-responsive"  height="150px" loading="lazy"
                    src="{{ $urlProfile }}" alt="profil_user" data-file="{{ $anak->foto }}" >
                {!! Form::file('anakasuh[foto]', $options) !!}
            </div>
            <div class="col-md-9" style="padding-left: 0px">
                <div class="form-group">
                    <input type="hidden" name="anakasuh[anakasuh_id]" value="{{ $anak->anakasuh_id }}">
                    <label class="col-md-3">Nama</label>
                    <div class="col-md-9">
                        @php
                            $options['placeholder'] = 'nama';
                        @endphp
                        {!! Form::text('anakasuh[nama]', $anak->nama??'', $options) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Tempat / Tgl Lahir</label>
                    <div class="col-md-5">
                        @php
                            $options['placeholder'] = 'Tempat Lahir';
                        @endphp
                        {!! Form::text('anakasuh[tempat_lahir]', $anak->tempat_lahir??'', $options) !!}
                    </div>
                    <div class="col-md-4">
                        @php
                            $options['placeholder'] = 'Tanggal Lahir';
                        @endphp
                        {!! Form::date('anakasuh[tgl_lahir]', $anak->tgl_lahir??'', $options) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Jenis Kelamin</label>
                    <div class="col-md-9">
                        <div class="radio-list" style="padding-left: 20px">
                            @php
                                $gen = ['l','p'];
                                $init = array_fill_keys($gen,false);
                                $keyCek = $anak->gender??'';
                                if(isset($init[$keyCek])){
                                    $init[$keyCek] = true;
                                }
                            @endphp
                            @foreach ($init as $key => $item)
                                <label class="radio-inline">
                                    {!! Form::radio('anakasuh[gender]', $key, $item) !!}
                                    &nbsp;{{ ucwords($key) }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Status Anak</label>
                    <div class="col-md-9">
                        <div class="radio-list" style="padding-left: 20px">
                            @php
                                $sts = [0,1];
                                $init = array_fill_keys($sts,false);
                                $keyCek = $anak->is_yatim ?? '';
                                if(isset($sts[$keyCek])){
                                    $sts[$keyCek] = true;
                                }
                                $labelIsyatim = ['Yatim Piatu', 'Yatim'];
                            @endphp
                            @foreach ($sts as $key => $item)
                                <label class="radio-inline">
                                    {!! Form::radio('anakasuh[is_yatim]', $key, $item) !!}
                                    &nbsp;{{ $labelIsyatim[$key] }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Status Yatim</label>
                    <div class="col-md-9">
                        <div class="radio-list" style="padding-left: 20px">
                            @php
                                $sts = [0,1];
                                $init = array_fill_keys($sts,false);
                                $keyCek = $anak->is_sebelum_yatim ?? '';
                                if(isset($sts[$keyCek])){
                                    $sts[$keyCek] = true;
                                }
                                $labelYatim = ['Sebelum Lahir', 'Setelah Lahir'];
                            @endphp
                            @foreach ($sts as $key => $item)
                                <label class="radio-inline">
                                    {!! Form::radio('anakasuh[is_sebelum_yatim]', $key, $item) !!}
                                    &nbsp;{{ $labelYatim[$key] }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Yatim dari Umur</label>
                    <div class="col-md-5">
                        @php
                            $options['placeholder'] = 'Yatim dari Umur';
                        @endphp
                        {!! Form::text('anakasuh[yatim_umur]', $anak->yatim_umur??'', $options) !!}
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Data Orang Tua Kandung</legend>
            <div class="form-group">
                <label class="col-md-3">Nama Ayah / Ibu</label>
                <div class="col-md-5">
                    {!! Form::hidden('orangtua[parent_id]', $anak->parent->parent_id??'') !!}
                    @php
                        $options['placeholder'] = 'Nama Ayah / Ibu';
                    @endphp
                    {!! Form::text('orangtua[nama]', $anak->parent->nama??'', $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Pekerjaan</label>
                <div class="col-md-5">
                    @php
                        $options['placeholder'] = 'Pekerjaan Orang Tua';
                    @endphp
                    {!! Form::text('orangtua[pekerjaan]', $anak->parent->pekerjaan??'', $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Alamat Tinggal</label>
                <div class="col-md-9">
                    @php
                        $options['class'] = 'form-control';
                        $options['placeholder'] = 'Alamat Tempat Tinggal';
                        $textarea = ['rows' => 2];
                    @endphp
                    {!! Form::textarea('orangtua[alamat]', $anak->parent->alamat??'', array_merge($options,$textarea)) !!}
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Data Pengasuh & Kordes</legend>
            <div class="form-group">
                <label class="col-md-3">Nama</label>
                <div class="col-md-5">
                    {!! Form::hidden('pengasuh[pengasuh_id]', $anak->pengasuh->pengasuh_id??'') !!}
                    @php
                        $options['class'] = 'form-control input-sm';
                        $options['placeholder'] = 'Nama Pengasuh';
                    @endphp
                    {!! Form::text('pengasuh[nama]', $anak->pengasuh->nama??'', $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Pekerjaan</label>
                <div class="col-md-5">
                    @php
                        $options['placeholder'] = 'Pekerjaan Pengasuh';
                    @endphp
                    {!! Form::text('pengasuh[pekerjaan]', $anak->pengasuh->pekerjaan??'', $options) !!}
                </div>
                <div class="col-md-4">
                    @php
                        $options['placeholder'] = 'No HP';
                    @endphp
                    {!! Form::text('pengasuh[no_hp]', $anak->pengasuh->no_hp??'', $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Alamat Tinggal</label>
                <div class="col-md-9">
                    @php
                        $options['class'] = 'form-control';
                        $options['placeholder'] = 'Alamat Tempat Tinggal';
                    @endphp
                    {!! Form::textarea('pengasuh[alamat]', $anak->pengasuh->alamat??'', array_merge($options, $textarea)) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Nama Kordes</label>
                <div class="col-md-5">
                    {!! Form::hidden('kordes[kordes_id]', $anak->kordes->kordes_id??'') !!}
                    @php
                        $options['class'] = 'form-control input-sm';
                        $options['placeholder'] = 'Nama Kordes';
                    @endphp
                    {!! Form::text('kordes[nama]', $anak->kordes->nama??'', $options) !!}
                </div>
                <div class="col-md-4">
                    @php
                        $options['placeholder'] = 'Tahun Masuk';
                    @endphp
                    {!! Form::number('kordes[tahun]', $anak->kordes->tahun??'', $options) !!}
                </div>
            </div>
        </fieldset>
    </div>
</div>
@endsection
