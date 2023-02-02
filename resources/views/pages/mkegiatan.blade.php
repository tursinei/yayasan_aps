@extends('layouts.master')

@section('title', 'Kegiatan')
{{-- @section('subTitle', 'Welcome, this page after login') --}}

@section('content')
    <div class="row">
        <div class="col-md-8">
            <form class="form-horizontal" role="form" id="fo-kegiatan">
                <div class="form-group">
                    <input type="hidden" name="kegiatan_id" value="">
                    <label class="col-md-3">Nama Kegiatan</label>
                    <div class="col-md-6">
                        @php
                            $options= [
                                'placeholder' => 'Nama Kegiatan',
                                'class' =>'form-control input-sm'
                            ];
                        @endphp
                        {!! Form::text('kegiatan', '', $options) !!}
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox-list">
                            <label class="">
                                {!! Form::checkbox('bukan_santunan', 1) !!}
                                Bukan Santunan
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 text-right">
                        <button type="reset" class="btn btn-sm btn-default">Reset</button>
                        <button type="submit" class="btn btn-sm btn-success "><i class="fa fa-save"></i>&nbsp;Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="tbl-data" class="table table-striped table-hover table-green">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 10%;">No</th>
                        <th class="text-center" style="width: 60%;">Nama Program</th>
                        <th class="text-center" style="width: 20%;">Jenis</th>
                        <th class="text-center" style="width: 10%;">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3" class="text-center">Loading data... <i class="fa fa-spin fa-spinner"></i>
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
                url: '{{ route('kegiatan.index') }}',
                colId: 'kegiatan_id',
                cols: [
                    { key: 'kegiatan', class: ''},
                    { key: 'santunan', class: 'text-center'},
                ]
            });
        }).on('reset', '#fo-kegiatan', function(e) {
            $('input[name="kegiatan_id"]').val('');
            $('input[name="bukan_santunan"]').prop('checked',false).parent().removeClass('checked');
        }).on('submit', '#fo-kegiatan', function(e) {
            e.preventDefault();
            let fo = $(this),
                data = fo.serializeArray(),
                btn = fo.find('button[type="submit"]');
            gAjax(btn.find('i'), {
                url: `{{ route('kegiatan.store') }}`,
                dataType: 'JSON',
                data: data,
                type: 'POST',
                done: function(e) {
                    msgSuccess(e.message);
                    fo.trigger('reset');
                    $('#tbl-data').tPaginate('reload');
                }
            });
        }).on('click', '.btn-update', function name(e) {
            let b = $(this);
            let url = `{{ route('kegiatan.show', ['kegiatan' => ':id']) }}`;
            url = url.replace(':id', b.attr('data-id'));
            gAjax(b.find('i'), {
                url: url,
                dataType: 'json',
                done: function(res) {
                    $('input[name="kegiatan_id"]').val(res.kegiatan_id);
                    $('input[name="kegiatan"]').val(res.kegiatan);
                    let c = $('input[name="bukan_santunan"]').prop('checked',res.bukan_santunan).parent().removeClass('checked');
                    if(res.bukan_santunan){
                        console.log(c);
                        c.addClass('checked');
                    }
                }
            });
        }).on('click', '.btn-delete', function() {
            let b = $(this);
            let url = `{{ route('kegiatan.destroy', ['kegiatan' => ':id']) }}`;
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
