@extends('layouts.master')

@section('title', 'Calon Yatama')
{{-- @section('subTitle', 'Welcome, this page after login') --}}
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <table id="tbl-data" class="table table-striped table-hover table-green">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th class="text-center" style="width: 30%;">Nama</th>
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
                url: '{{ route('calonyatama.index') }}',
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
                    }, function(obj,td) {
                        let bUpdate = '<button type="button" data-id="'+obj.calon_id+'" class="btn btn-xs btn-info btn-update"><i class="fa fa-pencil"></i></button>';
                        let bDel = '<button type="button" data-id=""'+obj.calon_id+'" class="btn btn-xs btn-delete btn-danger"><i class="fa fa-trash"></i></button>';
                        let btns = bUpdate+'&nbsp;'+bDel;
                        if(obj.status == 2){
                            return '';
                        }
                        td.addClass('text-center');
                        return btns;

                    }
                ]
            });
        }).on('submit', '#fo-yatama', function(e) {
            e.preventDefault();
            let fo = $(this),
                data = toFormData(fo),
                btn = fo.find('button[type="submit"]');
            gAjax(btn.find('i'), {
                url: `{{ route('calonyatama.store') }}`,
                dataType: 'JSON',
                data: data,
                processData :false,
                contentType : false,
                type: 'POST',
                done: function(e) {
                    fo.parents('div.modal').modal('hide');
                    msgSuccess(e.message);
                    $('#tbl-data').tPaginate('reload');
                }
            });
        }).on('click', '.btn-update', function name(e) {
            let b = $(this);
            let url = `{{ route('calonyatama.show', ['calonyatama' => ':id']) }}`;
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
        }).on('click', '.btn-delete', function() {
            let b = $(this);
            let url = `{{ route('calonyatama.destroy', ['calonyatama' => ':id']) }}`;
            url = url.replace(':id', b.attr('data-id'));
            bootbox.confirm('{{ trans('crud.hapusConfirm') }}', function(ans) {
                if (ans) {
                    gAjax(b.find('i'), {
                        url: url,
                        dataType: 'JSON',
                        type: 'DELETE',
                        done: function(e) {
                            b.parents('tr:first').remove();1
                        }
                    });
                }
            });
        });
    </script>
@endpush
