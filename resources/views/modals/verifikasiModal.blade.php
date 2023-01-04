@extends('layouts.modal',['modalTitle' => 'Konfirmasi data Calon Yatama', 'idForm' => 'fo-calonYatama', 'isLarge' => true])

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
            </div>
            <div class="col-md-9" style="padding-left: 0px">
                <div class="form-group">
                    <input type="hidden" name="calon_id" value="{{ $anak->calon_id }}">
                    <input type="hidden" name="status" value="2" alt="Diterima">
                    <label class="col-md-3 control-label pt-0">Nama</label>
                    <label class="col-md-9"> {{ $anak->nama??'' }}</label>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label pt-0">Tempat / Tgl Lahir</label>
                    <label class="col-md-9"> {{ ($anak->tempat_lahir??'').', '.($anak->tgl_lahir->format('d-m-Y')??'') }} </label>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label pt-0">Jenis Kelamin</label>
                    <label class="col-md-9">
                            @if ($anak->gender == 'l')
                                Laki-laki
                            @else
                                Perempuan
                            @endif
                    </label>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label pt-0">Status Anak</label>
                    <label class="col-md-9">
                        @if ($anak->is_yatim)
                            Yatim Piatu
                        @else
                            Yatim
                        @endif
                    </label>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label pt-0">Status Yatim</label>
                    <label class="col-md-9">
                        @if ($anak->is_sebelum_yatim)
                            Sebelum Lahir
                        @else
                            Setelah Lahir
                        @endif
                    </label>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label pt-0">Yatim dari Umur</label>
                    <label class="col-md-5"> {{ $anak->yatim_umur??'' }} </label>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Data Orang Tua Kandung</legend>
            <div class="form-group">
                <label class="col-md-2 pe-0 control-label pt-0">Nama Ayah / Ibu</label>
                <label class="col-md-5 ps-5">{{ $anak->parent->nama??'' }} </label>
            </div>
            <div class="form-group">
                <label class="col-md-2 pe-0 control-label pt-0">Pekerjaan</label>
                <label class="col-md-5 ps-5">
                    {{ $anak->parent->pekerjaan??'' }}
                </label>
            </div>
            <div class="form-group">
                <label class="col-md-2 pe-0 control-label pt-0">Alamat Tinggal</label>
                <label class="col-md-9 ps-5">
                    {{ $anak->parent->alamat??'' }}
                </label>
            </div>
        </fieldset>
        <fieldset>
            <legend>Data Pengasuh</legend>
            <div class="form-group">
                <label class="col-md-2 pe-0 control-label pt-0">Nama</label>
                <label class="col-md-5 ps-5">
                    {{ $anak->pengasuh->nama??'' }}
                </label>
            </div>
            <div class="form-group">
                <label class="col-md-2 pe-0 control-label pt-0">Pekerjaan & no Hp</label>
                <label class="col-md-9 ps-5">
                    {{ ($anak->pengasuh->pekerjaan??'').' '.($anak->pengasuh->no_hp??'')  }}
                </label>
            </div>
            <div class="form-group">
                <label class="col-md-2 pe-0 control-label pt-0">Alamat Tinggal</label>
                <label class="col-md-9 ps-5">
                    {{ $anak->pengasuh->alamat??'' }}
                </label>
            </div>
        </fieldset>
    </div>
</div>
@endsection

@section('textButtonSave','Konfirmasi');

@section('leftButtons')
<button type="button" class="btn btn-sm btn-danger pull-left btn-tolak" title="DiTolak">
    <i class="fa fa-times"></i>&nbsp;DiTolak
</button>
@endsection


