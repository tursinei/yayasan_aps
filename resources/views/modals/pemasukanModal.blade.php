@extends('layouts.modal', ['modalTitle' => 'Form Pencatatan Pemasukan', 'idForm' => 'fo-pemasukan', 'isLarge' => true])

@section('ModalBody')
    @php
        $options = ['class' => 'form-control input-sm'];
    @endphp
    <div class="form-horizontal" role="form">
        <div class="form-body">
            <div class="form-group">
                <input type="hidden" name="pemasukan_id" value="{{ $pemasukan->pemasukan_id ?? '' }}">
                <label class="col-md-3 control-label pt-0">Tanggal</label>
                <div class="col-md-4">
                    @php
                        $valueData = $pemasukan->tgl ?? date('Y-m-d');
                    @endphp
                    {!! Form::date('tgl', $valueData, $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label pt-0">Kategori Pemasukan</label>
                <div class="col-md-3">
                    <div class="radio-list" style="padding-left: 20px">
                        @php
                            $sts = [1,0];
                            $init = array_fill_keys($sts,false);
                            $keyCek = $pemasukan->is_donasi ?? '';
                            if(isset($init[$keyCek])){
                                $init[$keyCek] = true;
                            } else {
                                $init[1] = true;
                            }
                            $labelIsyatim = ['Lainnya', 'Donasi'];
                        @endphp
                        @foreach ($init as $key => $item)
                            <label class="radio-inline">
                                {!! Form::radio('is_donasi', $key, $item) !!}
                                &nbsp;{{ $labelIsyatim[$key] }}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    @php
                        $tmpClass = $options['class'];
                        $options['placeholder'] = 'Masukkan nama kategori lainnya';
                        if(!$init[0]){
                            $options['class'] .= ' hidden';
                        }
                    @endphp
                    {!! Form::text('kategori_lain', $pemasukan->kategori_lain ?? '', $options) !!}
                </div>
            </div>
            <div class="form-group div-donasi @if ($init[0])
                {{ 'hidden' }}
            @endif">
                <label class="col-md-3 control-label pt-0">Nama Donatur</label>
                <div class="col-md-9">
                    @php
                        $options['class'] = $tmpClass;
                        $options['placeholder'] = 'Masukkan nama donatur (Optional, otomatis terisi Hamba Dermawan jika tidak diisi)';
                    @endphp
                    {!! Form::text('nama_donatur', $pemasukan->nama_donatur ?? '', $options) !!}
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
                    {!! Form::textarea('keterangan', $pemasukan->keterangan ?? '', $optionArea) !!}
                </label>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label pt-0">Nominal</label>
                <div class="col-md-5">
                    @php
                        $options['placeholder'] = '';
                        $nilai = $pemasukan->nominal??'';
                    @endphp
                    {!! Form::text('nominal', $nilai, $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label pt-0">Kurator</label>
                <div class="col-md-5">
                    @php
                        $options['placeholder'] = '--Pilih Kurator--';
                    @endphp
                    {!! Form::select('kurator_id', $kurator, $pemasukan->kurator_id??'', $options) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
