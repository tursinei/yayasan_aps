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
                    @php
                        $keyId = 'anakasuh_id';
                        $valueId = $anak->anakasuh_id;
                        if(isset($anak->calon_id)){
                            $keyId = 'calon_id';
                            $valueId = $anak->calon_id;
                        }
                    @endphp
                    <input type="hidden" name="anakasuh[{{ $keyId }}]" value="{{ $valueId }}">
                    <label class="col-md-3 control-label">Nama</label>
                    <div class="col-md-9">
                        @php
                            $options['placeholder'] = 'nama';
                        @endphp
                        {!! Form::text('anakasuh[nama]', $anak->nama??'', $options) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tempat / Tgl Lahir</label>
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
                    <label class="col-md-3 control-label">Jenis Kelamin</label>
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
                    <label class="col-md-3 control-label">Status Anak</label>
                    <div class="col-md-9">
                        <div class="radio-list" style="padding-left: 20px">
                            @php
                                $sts = [0,1];
                                $init = array_fill_keys($sts,false);
                                $keyCek = $anak->is_yatim ?? '';
                                if(isset($init[$keyCek])){
                                    $init[$keyCek] = true;
                                }
                                $labelIsyatim = ['Yatim Piatu', 'Yatim'];
                            @endphp
                            @foreach ($init as $key => $item)
                                <label class="radio-inline">
                                    {!! Form::radio('anakasuh[is_yatim]', $key, $item) !!}
                                    &nbsp;{{ $labelIsyatim[$key] }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Status Yatim</label>
                    <div class="col-md-9">
                        <div class="radio-list" style="padding-left: 20px">
                            @php
                                $sts = [0,1];
                                $init = array_fill_keys($sts,false);
                                $keyCek = $anak->is_sebelum_yatim ?? '';
                                if(isset($init[$keyCek])){
                                    $init[$keyCek] = true;
                                }
                                $labelYatim = ['Sebelum Lahir', 'Setelah Lahir'];
                            @endphp
                            @foreach ($init as $key => $item)
                                <label class="radio-inline">
                                    {!! Form::radio('anakasuh[is_sebelum_yatim]', $key, $item) !!}
                                    &nbsp;{{ $labelYatim[$key] }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Yatim dari Umur</label>
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
                <label class="col-md-2 pe-0 control-label">Nama Ayah / Ibu</label>
                <div class="col-md-5 ps-5">
                    {!! Form::hidden('orangtua[parent_id]', $anak->parent->parent_id??'') !!}
                    @php
                        $options['placeholder'] = 'Nama Ayah / Ibu';
                    @endphp
                    {!! Form::text('orangtua[nama]', $anak->parent->nama??'', $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 pe-0 control-label">Pekerjaan</label>
                <div class="col-md-5 ps-5">
                    @php
                        $options['placeholder'] = 'Pekerjaan Orang Tua';
                    @endphp
                    {!! Form::text('orangtua[pekerjaan]', $anak->parent->pekerjaan??'', $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 pe-0 control-label">Alamat Tinggal</label>
                <div class="col-md-9 ps-5">
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
                <label class="col-md-2 pe-0 control-label">Nama</label>
                <div class="col-md-5 ps-5">
                    {!! Form::hidden('pengasuh[pengasuh_id]', $anak->pengasuh->pengasuh_id??'') !!}
                    @php
                        $options['class'] = 'form-control input-sm';
                        $options['placeholder'] = 'Nama Pengasuh';
                    @endphp
                    {!! Form::text('pengasuh[nama]', $anak->pengasuh->nama??'', $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 pe-0 control-label">Pekerjaan</label>
                <div class="col-md-5 ps-5">
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
                <label class="col-md-2 pe-0 control-label">Alamat Tinggal</label>
                <div class="col-md-9 ps-5">
                    @php
                        $options['class'] = 'form-control';
                        $options['placeholder'] = 'Alamat Tempat Tinggal';
                    @endphp
                    {!! Form::textarea('pengasuh[alamat]', $anak->pengasuh->alamat??'', array_merge($options, $textarea)) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 pe-0 control-label">Nama Kordes</label>
                <div class="col-md-4 ps-5">
                    @php
                        $options['class'] = 'form-control input-sm';
                        $options['placeholder'] = '--Pilih Kordes--';
                    @endphp
                    {!! Form::select('anakasuh[user_id]',$kordes, $anak->user_id??'', $options) !!}
                </div>
                <label class="col-md-2 pe-0 control-label">Nama Kordes</label>
                <div class="col-md-3">
                    @php
                        $options['placeholder'] = 'Tahun Tanggal Masuk';
                    @endphp
                    {!! Form::date('anakasuh[tgl_masuk]',$anak->tgl_masuk??'', $options) !!}
                </div>
            </div>
        </fieldset>
    </div>
</div>
@endsection
