@extends('layouts.master')

@section('title', 'Pemasukan')

@section('content')
<div class="row">
    <div class="col-md-3">
        <button type="button" class="btn btn-sm btn-success btn-add"><i class="fa fa-plus"></i>&nbsp;Tambah Pemasukan</button>
    </div>
    <div class="col-md-12">
        <table id="tbl-pemasukan" class="table table-striped table-hover table-green">
            <thead>
                <tr>
                    <th class="text-center" style="width: 10%;">Tanggal</th>
                    <th class="text-center" style="width: 10%;">Kategori</th>
                    <th class="text-center" style="width: 25%;">Nama Donatur&nbsp;/&nbsp;Lainnya</th>
                    <th class="text-center" style="width: 20%;">Keterangan</th>
                    <th class="text-center" style="width: 15%;">Nominal</th>
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
            $('#tbl-pemasukan').tPaginate({
                colId: 'pemasukan_id',
                numbering : false,
                cols: [
                    { key: 'tgl', class: 'text-center'},
                    { key: 'kategori', class: 'text-center'},
                    { key: 'donatur_lainnya'},
                    { key: 'keterangan' },
                    { key: 'nominal', class:'text-right'},
                    { key: 'kurator'},
                ]
            });
        }).on('click', '.btn-add', function(e) {
            let b = $(this);
            gAjax(b.find('i'),{
                url : '{{ route('pemasukan.create') }}',
                dataType : 'html',
                done :  function (res) {
                    showModal(res).find('input[name=nominal]').mask('#.##0',{reverse : true});
                }
            });
        }).on('click', 'input[name=is_donasi]', function(e) {
            let c = $(this),lain = c.parents('div.form-group').find('input[name=kategori_lain]');
            let divDonasi = $('.div-donasi');
            lain.addClass("hidden");
            divDonasi.removeClass('hidden');
            if(c.val() == 0){
                lain.removeClass('hidden');
                divDonasi.addClass('hidden');
            }
        }).on('submit', '#fo-pemasukan', function(e) {
            e.preventDefault();
            let fo = $(this),
                data = fo.serializeArray(),
                btn = fo.find('button[type="submit"]');
            gAjax(btn.find('i'), {
                url: `{{ route('pemasukan.store') }}`,
                dataType: 'JSON',
                data: data,
                type: 'POST',
                done: function(e) {
                    fo.parents('div.modal').modal('hide');
                    msgSuccess(e.message);
                    $('#tbl-pemasukan').tPaginate('reload');
                }
            });
        }).on('click', '.btn-update', function name(e) {
            let b = $(this);
            let url = `{{ route('pemasukan.show', ['pemasukan' => ':id']) }}`;
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
            let url = `{{ route('pemasukan.destroy', ['pemasukan' => ':id']) }}`;
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
