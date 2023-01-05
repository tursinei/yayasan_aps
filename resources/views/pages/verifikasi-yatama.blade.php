@extends('layouts.master')

@section('title', 'Verifikasi')
{{-- @section('subTitle', 'Welcome, this page after login') --}}
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <table id="tbl-data" class="table table-bordered table-striped table-hover table-green">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th class="text-center" style="width: 20%;">Nama</th>
                        <th class="text-center" style="width: 5%;">Gender</th>
                        <th class="text-center" style="width: 10%;">Tanggal Lahir</th>
                        <th class="text-center" style="width: 10%;">Yatim&nbsp;/&nbsp;Piatu</th>
                        <th class="text-center" style="width: 10%;">Anak&nbsp;Ke</th>
                        <th class="text-center" style="width: 10%;">Tanggal Masuk</th>
                        <th class="text-center" style="width: 10%;">Status</th>
                        <th class="text-center" style="width: 10%;">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="8" class="text-center">Loading data... <i class="fa fa-spin fa-spinner"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(params) {
            $('#tbl-data').tPaginate({
                useButtons : false,
                cols: [
                    { key: 'nama', class: ''},
                    { key: 'gender', class: 'text-center'},
                    { key: 'tgl_lahir', class: 'text-center' },
                    { key: 'is_yatim', class: 'text-center' },
                    { key: 'anak_ke', class: 'text-center' },
                    { key: 'tgl_masuk', class: 'text-center' },
                    function(obj, td) {
                        let lbl = 'label-default', text = 'Belum divalidasi', label = $('<label/>');
                        if(obj.status == 1){
                            lbl = 'label-danger';
                            text = 'Ditolak';
                            label.attr('title', obj.alasan_tolak);
                        } else if(obj.status == 2){
                            lbl = 'label-success';
                            text = 'Divalidasi';
                        }
                        label.addClass('label label-sm '+lbl);
                        label.text(text);
                        td.addClass('text-center');
                        return label;
                    },
                    function(obj, td) {
                        td.addClass('text-center');
                        return `<button type="button" data-id="${obj.calon_id}" title="Konfirmasi" class="btn btn-xs btn-success btn-confirm"><i class="fa fa-gavel"></i></button>`;
                    }
                ]
            });
        }).on('submit', '#fo-calonYatama', function(e) {
            e.preventDefault();
            let fo = $(this),
                data = fo.serializeArray(),
                btn = fo.find('button[type="submit"]');
                gAjax(btn.find('i'), {
                    url: `{{ route('verifikasi.store') }}`,
                    dataType: 'JSON',
                    data: data,
                    type: 'POST',
                    done: function(e) {
                        fo.parents('div.modal').modal('hide');
                        msgSuccess(e.message);
                        $('#tbl-data').tPaginate('reload');
                    }
                });
        }).on('click', '.btn-confirm', function name(e) {
            let b = $(this);
            let url = `{{ route('verifikasi.show', ['verifikasi' => ':id']) }}`;
            url = url.replace(':id', b.attr('data-id'));
            gAjax(b.find('i'), {
                url: url,
                dataType: 'html',
                done: function(res) {
                    $(res).modal().on('hidden.bs.modal',function(el,e) {
                        $(el.target).remove();
                    });
                }
            });
        }).on('click', '.btn-tolak', function name(e) {
            let b = $(this);
            let url = `{{ route('verifikasi.show', ['verifikasi' => ':id']) }}`;
            url = url.replace(':id', b.attr('data-id'));
            bootbox.prompt({
                title  : 'Berikan alasan ketika menolak.',
                inputType   : 'textarea',
                callback : function (answer) {
                    if(answer){
                        let data = $('#fo-calonYatama').serializeArray();
                        data.push({
                            name : 'status',
                            value : 1,
                        });
                        data.push({
                            name : 'alasan_tolak',
                            value : answer,
                        });
                        gAjax(b.find('i'), {
                            url: `{{ route('verifikasi.store') }}`,
                            dataType: 'JSON',
                            data: data,
                            type: 'POST',
                            done: function(e) {
                                b.parents('div.modal').modal('hide');
                                msgSuccess(e.message);
                                $('#tbl-data').tPaginate('reload');
                            }
                        });
                    }
                }
            });

        });
    </script>
@endpush
