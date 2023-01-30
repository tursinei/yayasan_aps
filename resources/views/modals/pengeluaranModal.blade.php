@extends('layouts.modal', ['modalTitle' => 'Form Pencatatan Pengeluaran', 'idForm' => 'fo-pengeluaran', 'isLarge' => true])

@section('ModalBody')
    @php
        $options = ['class' => 'form-control input-sm'];
    @endphp
    <div class="form-horizontal" role="form">
        <div class="form-body">
            <div class="form-group">
                <input type="hidden" name="pengeluaran_id" value="{{ $pengeluaran->pengeluaran_id ?? '' }}">
                <label class="col-md-3 control-label pt-0">Tanggal</label>
                <div class="col-md-4">
                    @php
                        $valueData = $pengeluaran->tgl ?? date('Y-m-d');
                        $idkegiatan = $pengeluaran->kegiatan_id ?? '';
                    @endphp
                    {!! Form::date('tgl', $valueData, $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label pt-0">Kegiatan</label>
                <div class="col-md-9">
                    <select name="kegiatan_id" id="kegiatan_id" class="form-control input-sm">
                        <option value="">--Pilih Kegiatan--</option>
                    @foreach ($kegiatans as $keg)
                        <option @if ($keg->kegiatan_id == $idkegiatan)
                            selected="true"
                        @endif data-santunan="{{ $keg->bukan_santunan }}" value="{{ $keg->kegiatan_id }}">{{ $keg->kegiatan }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label pt-0">Program</label>
                <div class="col-md-9">
                    @php
                        $options['placeholder'] = '--Pilih Program (Optional)--';
                    @endphp
                    {!! Form::select('program_id', $programs, $pengeluaran->program_id??'', $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label pt-0">Keterangan</label>
                <label class="col-md-9">
                    @php
                        $optionArea = $options;
                        $optionArea['rows'] = 3;
                        $optionArea['placeholder'] = '';
                    @endphp
                    {!! Form::textarea('keterangan', $pengeluaran->keterangan ?? '', $optionArea) !!}
                </label>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label pt-0">Nominal</label>
                <div class="col-md-5">
                    @php
                        $options['placeholder'] = '';
                        $nilai = $pengeluaran->nominal??'';
                    @endphp
                    {!! Form::text('nominal', $nilai, $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label pt-0">Kurator</label>
                <div class="col-md-9">
                    @php
                        $options['placeholder'] = 'Masukkan Kurator';
                    @endphp
                    {!! Form::text('kurator', $pengeluaran->kurator??'', $options) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
