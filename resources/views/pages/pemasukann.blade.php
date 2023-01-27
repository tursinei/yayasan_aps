@extends('layouts.master')

@section('title', 'Pemasukan')

@section('content')
<div class="row mb-5">
    <div class="col-md-3">
        <button type="button" class="btn btn-sm btn-success btn-add"><i class="fa fa-plus"></i>&nbsp;Tambah Pemasukan</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table id="tbl-pemasukan" class="table table-striped table-hover table-green">
            <thead>
                <tr>
                    <th class="text-center" style="width: 10%;">Tanggal</th>
                    <th class="text-center" style="width: 20%;">Kategori</th>
                    <th class="text-center" style="width: 20%;">Nama Donatur</th>
                    <th class="text-center" style="width: 20%;">Keterangan</th>
                    <th class="text-center" style="width: 15%;">Nominal</th>
                    <th class="text-center" style="width: 10%;">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(params) {
            $('#tbl-pemasukan').tPaginate({
                colId: 'pemasukan_id',
                numbering : false,
                cols: [
                    { key: 'tgl', class: 'text-center'},
                    { key: 'is_donasi', class: 'text-left'},
                    { key: 'nama_donatur'},
                    { key: 'keterangan' },
                    { key: 'nominal'},
                ]
            });
        }).on('click', '.btn-add', function(e) {
            let b = $(this);
            gAjax(b.find('i'),{
                url : '{{ route('rekammedis.create') }}',
                data : {id:cb.val()},
                dataType : 'html',
                done :  function (res) {
                    showModal(res);
                }
            });
        }).on('submit', '#fo-rekamMedis', function(e) {
            e.preventDefault();
            let fo = $(this),
                data = fo.serializeArray(),
                btn = fo.find('button[type="submit"]');
            gAjax(btn.find('i'), {
                url: `{{ route('rekammedis.store') }}`,
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
            let url = `{{ route('rekammedis.show', ['rekammedi' => ':id']) }}`;
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
            let url = `{{ route('rekammedis.destroy', ['rekammedi' => ':id']) }}`;
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
