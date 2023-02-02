@extends('layouts.master')

@section('title', 'RAB')

@section('content')

@php
$thn = [];
foreach (range(date('Y'),2022) as $year) {
    $thn[$year] = $year;
}

$options = [
    'placeholder' => '--Pilih Tahun--',
    'class' => 'input-sm form-control',
];
@endphp
    <div class="row">
        <div class="col-md-3">
            {!! Form::select('tahun', $thn, date('Y'), $options) !!}
        </div>
        <div class="col-md-2">
            <button class="btn btn-sm btn-success" id="btn-add"><i class="fa fa-plus"></i> Tambah RAB</button>
        </div>
        <div class="col-md-12">
            <table id="tbl-data" class="table table-striped table-hover table-green">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 10%;">No</th>
                        <th class="text-center" style="width: 40%;">Nama Program</th>
                        <th class="text-center" style="width: 30%;">Keterangan</th>
                        <th class="text-center" style="width: 20%;">Nominal</th>
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
            $('select[name="tahun"]').trigger('change');
        }).on('change','select[name="tahun"]',function() {
            let cb = $(this), data = {thn : cb.val()};
            $('#tbl-data').tPaginate({
                colId : 'rab_id',
                data : data,
                cols: [
                    { key: 'program'},
                    { key: 'uraian'},
                    { key: 'nominal'},
                ]
            });
        }).on('click', '#btn-add', function(e) {
            let b = $(this), thn = $('select[name="tahun"]').val();
            if(thn == ''){
                msgAlert('Pilih tahun terlebih dahulu');
                return false;
            }
            gAjax(b.find('i'),{
                url : '{{ route('rab.create') }}',
                data : {thn : thn},
                dataType :  'html',
                done : function(res) {
                    showModal(res);
                }
            });
        }).on('submit', '#fo-rab', function(e) {
            e.preventDefault();
            let fo = $(this),
                data = fo.serializeArray(),
                btn = fo.find('button[type="submit"]');
            gAjax(btn.find('i'), {
                url: `{{ route('rab.store') }}`,
                dataType: 'JSON',
                data: data,
                type: 'POST',
                done: function(e) {
                    msgSuccess(e.message);
                    fo.parents('div.modal').modal('hide');
                    $('#tbl-data').tPaginate('reload');
                }
            });
        }).on('click', '.btn-update', function name(e) {
            let b = $(this);
            let url = `{{ route('rab.show', ['rab' => ':id']) }}`;
            url = url.replace(':id', b.attr('data-id'));
            gAjax(b.find('i'), {
                url: url,
                dataType: 'html',
                done: function(res) {
                    showModal(res);
                }
            });
        }).on('click', '.btn-delete', function() {
            let b = $(this);
            let url = `{{ route('rab.destroy', ['rab' => ':id']) }}`;
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
