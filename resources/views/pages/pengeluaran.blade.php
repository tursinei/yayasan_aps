@extends('layouts.master')

@section('title', 'Pengeluaran')

@section('content')
<div class="row">
    <div class="col-md-3">
        <button type="button" class="btn btn-sm btn-success btn-add"><i class="fa fa-plus"></i>&nbsp;Tambah Pengeluaran</button>
    </div>
    <div class="col-md-12">
        <table id="tbl-pengeluaran" class="table table-striped table-hover table-green">
            <thead>
                <tr>
                    <th class="text-center" style="width: 10%;">Tanggal</th>
                    <th class="text-center" style="width: 20%;">Kegiatan</th>
                    <th class="text-center" style="width: 20%;">Program</th>
                    <th class="text-center" style="width: 20%;">Keterangan</th>
                    <th class="text-center" style="width: 10%;">Nominal</th>
                    <th class="text-center" style="width: 10%;">Kurator</th>
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
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(params) {
            $('#tbl-pengeluaran').tPaginate({
                colId: 'pengeluaran_id',
                numbering : false,
                cols: [
                    { key: 'tgl', class: 'text-center'},
                    { key: 'kegiatan'},
                    { key: 'program'},
                    { key: 'keterangan' },
                    { key: 'nominal', class:'text-right'},
                    { key: 'kurator'},
                ]
            });
        }).on('click', '.btn-add', function(e) {
            let b = $(this);
            gAjax(b.find('i'),{
                url : '{{ route('pengeluaran.create') }}',
                dataType : 'html',
                done :  function (res) {
                    showModal(res).find('input[name=nominal]').mask('#.##0',{reverse : true});
                }
            });
        }).on('change', 'select[name=kegiatan_id]', function(e) {
            let c = $(this),opt = c.find('option:selected');
            $('input[name=kurator]').val('').removeAttr('readonly')
            if(opt.attr('data-santunan') == ''){ // cek bukan santunan
                $('input[name=kurator]').val('KULIA').attr('readonly','true')
            }
        }).on('submit', '#fo-pengeluaran', function(e) {
            e.preventDefault();
            let fo = $(this),
                data = fo.serializeArray(),
                btn = fo.find('button[type="submit"]');
            let isBukanSantunan = $('select[name=kegiatan_id] > option:selected').attr('data-santunan') == 1;
            let dataSantunan = {'name' : 'jenis', value : 'santunan'};
            if(isBukanSantunan){
                dataSantunan.value = 'bukansantunan'
            }
            data[data.length] = dataSantunan;
            gAjax(btn.find('i'), {
                url: `{{ route('pengeluaran.store') }}`,
                dataType: 'JSON',
                data: data,
                type: 'POST',
                done: function(e) {
                    fo.parents('div.modal').modal('hide');
                    msgSuccess(e.message);
                    $('#tbl-pengeluaran').tPaginate('reload');
                }
            });
        }).on('click', '.btn-update', function name(e) {
            let b = $(this);
            let url = `{{ route('pengeluaran.show', ['pengeluaran' => ':id']) }}`;
            url = url.replace(':id', b.attr('data-id'));
            gAjax(b.find('i'), {
                url: url,
                dataType: 'html',
                done: function(res) {
                    showModal(res).find('input[name=nominal]').mask('#.##0',{reverse : true});
                }
            });
        }).on('click', '.btn-delete', function() {
            let b = $(this);
            let url = `{{ route('pengeluaran.destroy', ['pengeluaran' => ':id']) }}`;
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
