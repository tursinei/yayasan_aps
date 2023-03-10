@extends('layouts.master')

@section('title', 'Yatama')
{{-- @section('subTitle', 'Welcome, this page after login') --}}
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <table id="tbl-data" class="table  table-striped table-hover table-green">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th class="text-center" style="width: 40%;">Nama</th>
                        <th class="text-center" style="width: 5%;">Gender</th>
                        <th class="text-center" style="width: 10%;">Tanggal Lahir</th>
                        <th class="text-center" style="width: 10%;">Yatim&nbsp;/&nbsp;Piatu</th>
                        <th class="text-center" style="width: 10%;">Anak&nbsp;Ke</th>
                        <th class="text-center" style="width: 10%;">Tanggal Masuk</th>
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
                url: '{{ route('yatama.index') }}',
                colId: 'anakasuh_id',
                cols: [
                    { key: 'nama', class: ''},
                    { key: 'gender', class: 'text-center'},
                    { key: 'tgl_lahir', class: 'text-center' },
                    { key: 'is_yatim', class: 'text-center' },
                    { key: 'anak_ke', class: 'text-center' },
                    { key: 'tgl_masuk', class: 'text-center' },
                ]
            });
        }).on('reset', '#fo-users', function(e) {
            $('input[name="id"]').val('');
        }).on('submit', '#fo-yatama', function(e) {
            e.preventDefault();
            let fo = $(this),
                data = toFormData(fo),
                btn = fo.find('button[type="submit"]');
            gAjax(btn.find('i'), {
                url: `{{ route('yatama.store') }}`,
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
            let url = `{{ route('yatama.show', ['yatama' => ':id']) }}`;
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
            let url = `{{ route('yatama.destroy', ['yatama' => ':id']) }}`;
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
