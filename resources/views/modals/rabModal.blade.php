@extends('layouts.modal', ['modalTitle' => 'Form Input RAB', 'idForm' => 'fo-rab', 'isLarge' => false])

@section('ModalBody')
    @php
        $options = ['class' => 'form-control input-sm'];
    @endphp
    <div class="form-horizontal" role="form">
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-3 control-label">Tahun</label>
                <label class="col-md-9 mt-3"><strong>{{ $thn }}</strong></label>
            </div>
            <div class="form-group">
                {!! Form::hidden('rab_id', $rab->rab_id??'') !!}
                {!! Form::hidden('tahun', $thn) !!}
                <label class="col-md-3 control-label pt-0">Program</label>
                <div class="col-md-9">
                    @php
                        $options['placeholder'] = '--Pilih Program--';
                    @endphp
                    {!! Form::select('program_id', $programs, $rab->program_id??'', $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label pt-0">Keterangan</label>
                <div class="col-md-9">
                    @php
                        $options['placeholder'] = 'Keterangan';
                        $options['rows'] = '2';
                    @endphp
                    {!! Form::textarea('uraian', $rab->uraian??'', $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label pt-0">Nominal</label>
                <div class="col-md-9">
                    @php
                        $options['placeholder'] = 'Nominal';
                        unset($options['rows']);
                    @endphp
                    {!! Form::number('nominal', $rab->nominal??'', $options) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
