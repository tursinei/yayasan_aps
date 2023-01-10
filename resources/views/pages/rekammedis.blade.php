@extends('layouts.master')

@section('title', 'Rekam Medis')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<div class="row mb-5">
    <div class="col-md-4">
        {!! Form::select('anakasuh', $listAnak, '', [
            'class' => 'form-control input-sm',
            'placeholder' => '-- Pilih yatama terlebih dahulu --'
        ]) !!}
    </div>
    <div class="col-md-3">
        <button type="button" class="btn btn-sm btn-success btn-add hidden"><i class="fa fa-plus"></i>&nbsp;Tambah Rekam Medis</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table id="tbl-data" class="table table-bordered table-striped table-hover table-green">
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">No</th>
                    <th class="text-center" style="width: 10%;">Tanggal Periksa</th>
                    <th class="text-center" style="width: 20%;">Keluhan</th>
                    <th class="text-center" style="width: 20%;">Diagnosa</th>
                    <th class="text-center" style="width: 20%;">Obat yg diberikan</th>
                    <th class="text-center" style="width: 15%;">Keterangan</th>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(params) {
            $('select[name="anakasuh"]').select2();
        }).on('change', 'select[name="anakasuh"]', function(e) {
            let b = $(this), bAdd = $('.btn-add');
            bAdd.addClass("hidden");
            if(b.val() != ''){
                bAdd.removeClass('hidden');
            }
            $('#tbl-data tbody').html('<tr><td colspan="8" class="text-center">Loading data... <i class="fa fa-spin fa-spinner"></i></td></tr>');
            url = '{{ route('rekammedis.index') }}?'
            $('#tbl-data').tPaginate({
                colId: 'rekam_medis_id',
                data : {'id' : b.val()},
                cols: [
                    { key: 'tgl_periksa', class: 'text-center'},
                    { key: 'keluhan', class: 'text-left'},
                    { key: 'diagnosa', class: '' },
                    { key: 'obat', class: '' },
                    { key: 'keterangan', class: '' },
                ]
            });
        }).on('click', '.btn-add', function(e) {
            let b = $(this), cb = $('select[name="anakasuh"]');
            if(cb.val() == ''){
                msgAlert('Pilih Yatama Terlebih dahulu');
                return false;
            }
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
