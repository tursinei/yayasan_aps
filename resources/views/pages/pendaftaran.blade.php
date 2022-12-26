@extends('layouts.master')

@section('title', 'Pendaftaran Calon Yatama')
{{-- @section('subTitle', 'Welcome, this page after login') --}}
@php
    $options = ['class' => 'form-control input-sm'];
@endphp
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form id="fo-users" class="form-horizontal" role="form">
                <div class="form-body">
                    <fieldset>
                        <legend>Data Pribadi</legend>
                        @php
                            $urlProfile = asset('img/user.png');
                        @endphp
                        <div class="col-md-3 pull-right text-center">
                            <img class="image-responsive" style="margin-bottom: 10px"  height="150px" loading="lazy"
                                src="{{ $urlProfile }}" alt="profil_user">
                            {!! Form::file('anakasuh[foto]', $options) !!}
                        </div>
                        <div class="col-md-9" style="padding-left: 0px">
                            <div class="form-group">
                                {!! Form::hidden('anakasuh[calon_id]', '') !!}
                                <label class="col-md-3">Nama</label>
                                <div class="col-md-9">
                                    @php
                                        $options['placeholder'] = 'Nama Yatama';
                                    @endphp
                                    {!! Form::text('anakasuh[nama]', '', $options) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3">Tempat / Tgl Lahir</label>
                                <div class="col-md-5">
                                    @php
                                        $options['placeholder'] = 'Tempat Lahir';
                                    @endphp
                                    {!! Form::text('anakasuh[tempat_lahir]','', $options) !!}
                                </div>
                                <div class="col-md-4">
                                    @php
                                        $options['placeholder'] = 'Tanggal Lahir';
                                    @endphp
                                    {!! Form::date('anakasuh[tgl_lahir]','', $options) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3">Jenis Kelamin</label>
                                <div class="col-md-9">
                                    <div class="radio-list" style="padding-left: 20px">
                                        @php
                                            $gen = ['l','p'];
                                            $init = array_fill_keys($gen,false);
                                        @endphp
                                        @foreach ($init as $key => $item)
                                            <label class="radio-inline">
                                                {!! Form::radio('anakasuh[gender]', $key) !!}
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
                                            $labelIsyatim = ['Yatim Piatu', 'Yatim'];
                                        @endphp
                                        @foreach ($sts as $key => $item)
                                            <label class="radio-inline">
                                                {!! Form::radio('anakasuh[is_yatim]', $key) !!}
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
                                            $labelYatim = ['Sebelum Lahir', 'Setelah Lahir'];
                                        @endphp
                                        @foreach ($sts as $key => $item)
                                            <label class="radio-inline">
                                                {!! Form::radio('anakasuh[is_sebelum_yatim]', $key) !!}
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
                                    {!! Form::text('anakasuh[yatim_umur]','', $options) !!}
                                </div>
                                <div class="col-md-4">
                                    @php
                                        $options['placeholder'] = 'Anak Ke';
                                    @endphp
                                    {!! Form::text('anakasuh[anak_ke]', '', $options) !!}
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Data Orang Tua Kandung</legend>
                        <div class="form-group">
                            <label class="col-md-3">Nama Ayah / Ibu</label>
                            <div class="col-md-5">
                                {!! Form::hidden('orangtua[parent_id]', '') !!}
                                @php
                                    $options['placeholder'] = 'Nama Ayah / Ibu';
                                @endphp
                                {!! Form::text('orangtua[nama]', '', $options) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Pekerjaan</label>
                            <div class="col-md-5">
                                @php
                                    $options['placeholder'] = 'Pekerjaan Orang Tua';
                                @endphp
                                {!! Form::text('orangtua[pekerjaan]', '', $options) !!}
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
                                {!! Form::textarea('orangtua[alamat]', '', array_merge($options,$textarea)) !!}
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Data Pengasuh & Kordes</legend>
                        <div class="form-group">
                            <label class="col-md-3">Nama</label>
                            <div class="col-md-5">
                                {!! Form::hidden('pengasuh[pengasuh_id]', '') !!}
                                @php
                                    $options['class'] = 'form-control input-sm';
                                    $options['placeholder'] = 'Nama Pengasuh';
                                @endphp
                                {!! Form::text('pengasuh[nama]', '', $options) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Pekerjaan & No HP</label>
                            <div class="col-md-5">
                                @php
                                    $options['placeholder'] = 'Pekerjaan Pengasuh';
                                @endphp
                                {!! Form::text('pengasuh[pekerjaan]', '', $options) !!}
                            </div>
                            <div class="col-md-4">
                                @php
                                    $options['placeholder'] = 'No HP';
                                @endphp
                                {!! Form::text('pengasuh[no_hp]', '', $options) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Alamat Tinggal</label>
                            <div class="col-md-9">
                                @php
                                    $options['class'] = 'form-control';
                                    $options['placeholder'] = 'Alamat Tempat Tinggal';
                                @endphp
                                {!! Form::textarea('pengasuh[alamat]', '', array_merge($options, $textarea)) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Nama Kordes</label>
                            <div class="col-md-5">
                                {!! Form::hidden('kordes[kordes_id]', '') !!}
                                @php
                                    $options['class'] = 'form-control input-sm';
                                    $options['placeholder'] = 'Nama Kordes';
                                @endphp
                                {!! Form::text('kordes[nama]', '', $options) !!}
                            </div>
                            <div class="col-md-4">
                                @php
                                    $options['placeholder'] = 'Tahun Masuk';
                                @endphp
                                {!! Form::number('kordes[tahun]', '', $options) !!}
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="reset" class="btn btn-sm btn-default" data-dismiss="modal">Reset</button>
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).on('submit', '#fo-users', function(e) {
            e.preventDefault();
            let fo = $(this),
                data = toFormData(fo),
                btn = fo.find('button[type="submit"]');
            gAjax(btn.find('i'), {
                url: `{{ route('calonyatama.store') }}`,
                dataType: 'JSON',
                data: data,
                processData : false,
                contentType : false,
                type: 'POST',
                done: function(e) {
                    fo[0].reset();
                    msgSuccess(e.message+' Data bisa dilihat di menu Calon Yatama');
                }
            });
        }).on('reset','#fo-users', function name(params) {
            $('input[type=radio]').prop('checked',false).parent('span').removeClass('checked');
        });
    </script>
@endpush
