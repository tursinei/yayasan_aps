@extends('layouts.modal', ['modalTitle' => 'Konfirmasi data Calon Yatama', 'idForm' => 'fo-pendidikan', 'isLarge' => false])

@section('ModalBody')
    @php
        $options = ['class' => 'form-control input-sm'];
    @endphp
    <div class="form-horizontal" role="form">
        <div class="form-body">
            <div class="form-group">
                {!! Form::hidden('pendidikan_id', $pendidikan->pendidikan_id??'') !!}
                <label class="col-md-3 control-label pt-0">Nama</label>
                <div class="col-md-9">
                    @php
                        $options['placeholder'] = '--Pilih Yatama --';
                    @endphp
                    {!! Form::select('anakasuh_id', $listAnak, $pendidikan->anakasuh_id??'', $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label pt-0">Jenjang Sekolah</label>
                <div class="col-md-9">
                    @php
                        $options['placeholder'] = 'Jenjang Pendidikan';
                    @endphp
                    {!! Form::text('jenjang', $pendidikan->jenjang??'', $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label pt-0">Nama Sekolah</label>
                <div class="col-md-9">
                    @php
                        $options['placeholder'] = 'Nama Sekolah';
                    @endphp
                    {!! Form::text('nama_sekolah', $pendidikan->nama_sekolah??'', $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label pt-0">Kelas</label>
                <div class="col-md-9">
                    @php
                        $options['placeholder'] = 'Kelas saat ini';
                    @endphp
                    {!! Form::select('kelas_id', $listKelas, $pendidikan->kelas_id??'', $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label pt-0">Wali Kelas</label>
                <div class="col-md-9">
                    @php
                        $options['placeholder'] = 'Nama Wali Kelas';
                    @endphp
                    {!! Form::text('wali_kelas', $pendidikan->wali_kelas??'', $options) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
