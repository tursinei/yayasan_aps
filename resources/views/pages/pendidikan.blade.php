@extends('layouts.master')

@section('title', 'Pendidikan')
@push('css')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-success btn-sm" id="btn-add"><i class="fa fa-plus"></i> Tambah data</button><br/>
            <table id="tbl-data" class="table table-bordered table-striped table-hover table-green">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th class="text-center" style="width: 30%;">Nama</th>
                        <th class="text-center" style="width: 5%;">Jenjang</th>
                        <th class="text-center" style="width: 20%;">Nama Sekolah</th>
                        <th class="text-center" style="width: 10%;">Kelas</th>
                        <th class="text-center" style="width: 20%;">Wali Kelas</th>
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
    <script src="{{ assets('js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(params) {
            $('#tbl-data').tPaginate({
                colId: 'pendidikan_id',
                cols: [
                    { key: 'nama', class: ''},
                    { key: 'jenjang', class: 'text-center'},
                    { key: 'nama_sekolah', class: '' },
                    { key: 'kelas_nama', class: 'text-center' },
                    { key: 'wali_kelas', class: 'text-left' },
                ]
            });
        }).on('click', '#btn-add', function(e) {
            let b = $(this);
            gAjax(b.find('i'),{
                url : '{{ route('pendidikan.create') }}',
                dataType : 'html',
                done :  function (res) {
                    showModal(res);
                    $('select[name="anakasuh_id"]').select2({
                        dropdownParent : $('#myModal .modal-content')
                    });
                }
            });
        }).on('submit', '#fo-pendidikan', function(e) {
            e.preventDefault();
            let fo = $(this),
                data = fo.serializeArray(),
                btn = fo.find('button[type="submit"]');
            gAjax(btn.find('i'), {
                url: `{{ route('pendidikan.store') }}`,
                dataType: 'JSON',
                data: data,
                type: 'POST',
                done: function(e) {
                    fo.parents('div.modal').modal('hide');
                    msgSuccess(e.message);
                    $('#tbl-data').tPaginate('reload');
                }
            });
        }).on('click', '.btn-update', function name(e) {
            let b = $(this);
            let url = `{{ route('pendidikan.show', ['pendidikan' => ':id']) }}`;
            url = url.replace(':id', b.attr('data-id'));
            gAjax(b.find('i'), {
                url: url,
                dataType: 'html',
                done: function(res) {
                    $(res).modal().on('hidden.bs.modal',function(el,e) {
                        $(el.target).remove();
                    });
                    $('select[name="anakasuh_id"]').select2({
                        dropdownParent: $('#myModal .modal-content')
                    });
                }
            });
        }).on('click', '.btn-delete', function() {
            let b = $(this);
            let url = `{{ route('pendidikan.destroy', ['pendidikan' => ':id']) }}`;
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
