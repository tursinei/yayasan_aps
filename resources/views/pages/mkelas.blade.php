@extends('layouts.master')

@section('title', 'Master Kelas')

@section('content')
    <div class="row">
        <div class="col-md-7">
            <form class="form-horizontal" role="form" id="fo-kelas">
                <div class="form-group">
                    <input type="hidden" name="kelas_id" value="">
                    <label class="col-md-3">Nama Kelas</label>
                    <div class="col-md-6">
                        @php
                            $options= [
                                'placeholder' => 'Nama Kelas',
                                'class' =>'form-control input-sm'
                            ];
                        @endphp
                        {!! Form::text('kelas_nama', '', $options) !!}
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox-list"><label class="checkbo-inline">
                            {!! Form::checkbox('lulus', 1, false, $options) !!}
                            &nbsp;Lulus
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
        <div class="col-md-6">
            <table id="tbl-data" class="table table-striped table-hover table-green">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 10%;">No</th>
                        <th class="text-center" style="width: 60%;">Nama Kelas</th>
                        <th class="text-center" style="width: 10%;">Lulus <i class="fa fa-question-circle"
                            title="Yatama akan masuk pilihan daftar Alumni,untuk dikonfirmasi"></i>
                        </th>
                        <th class="text-center" style="width: 20%;">&nbsp;</th>
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
                colId: 'kelas_id',
                cols: [
                    { key: 'kelas_nama', class: ''},
                    function(obj, td) {
                        td.addClass('text-center');
                        return obj.lulus ? '<i class="fa fa-check text-success"></i>' : '';
                    },
                ]
            });
        }).on('reset', '#fo-kelas', function(e) {
            $('input[name="kelas_id"]').val('');
            $('input[name="lulus"]').prop('checked', false).parent().removeClass('checked');
        }).on('submit', '#fo-kelas', function(e) {
            e.preventDefault();
            let fo = $(this),
                data = fo.serializeArray(),
                btn = fo.find('button[type="submit"]');
            gAjax(btn.find('i'), {
                url: `{{ route('kelas.store') }}`,
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
            let url = `{{ route('kelas.show', ['kela' => ':id']) }}`;
            url = url.replace(':id', b.attr('data-id'));
            gAjax(b.find('i'), {
                url: url,
                dataType: 'JSON',
                done: function(res) {
                    $('input[name="kelas_id"]').val(res.kelas_id);
                    $('input[name="kelas_nama"]').val(res.kelas_nama);
                    $('input[name="lulus"]').prop('checked',false).parent().removeClass('checked');
                    if(res.lulus){
                        $('input[name="lulus"]').prop('checked',true).parent().addClass('checked');
                    }

                }
            });
        }).on('click', '.btn-delete', function() {
            let b = $(this);
            let url = `{{ route('kelas.destroy', ['kela' => ':id']) }}`;
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
