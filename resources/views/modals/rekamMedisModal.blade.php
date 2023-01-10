@extends('layouts.modal', ['modalTitle' => 'Rekam Medis Yatama', 'idForm' => 'fo-rekamMedis', 'isLarge' => true])

@section('ModalBody')
    @php
        $options = ['class' => 'form-control input-sm'];
    @endphp
    <div class="form-horizontal" role="form">
        <div class="form-body">
            <div class="form-group">
                {!! Form::hidden('rekam_medis_id', $rekam->rekam_medis_id??'') !!}
                {!! Form::hidden('anakasuh_id', $anakasuh_id) !!}
                <label class="col-md-3 control-label pt-0">Tanggal Periksa</label>
                <div class="col-md-9">
                    @php
                        $options['placeholder'] = 'Tanggal Periksa';
                    @endphp
                    {!! Form::date('tgl_periksa', $rekam->tgl_periksa??'', $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label pt-0">Keluhan</label>
                <div class="col-md-9">
                    @php
                        $options['placeholder'] = 'Keluhan dari pasien';
                        $options['rows'] = '2';
                    @endphp
                    {!! Form::textarea('keluhan', $rekam->keluhan??'', $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label pt-0">Diagnosa</label>
                <div class="col-md-9">
                    @php
                        $options['placeholder'] = 'Hasil diagnosa';
                    @endphp
                    {!! Form::textarea('diagnosa', $rekam->diagnosa??'', $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label pt-0">Obat / Penanganan</label>
                <div class="col-md-9">
                    @php
                        $options['placeholder'] = 'Penanganan / Obat yang diberikan';
                    @endphp
                    {!! Form::textarea('obat', $rekam->obat??'', $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label pt-0">Keterangan</label>
                <div class="col-md-9">
                    @php
                        $options['placeholder'] = 'Keterangan';
                    @endphp
                    {!! Form::textarea('keterangan', $rekam->keterangan??'', $options) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
