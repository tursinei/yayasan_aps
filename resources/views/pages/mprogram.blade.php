@extends('layouts.master')

@section('title', 'Program')
{{-- @section('subTitle', 'Welcome, this page after login') --}}

@section('content')
    <div class="row">
        <div class="col-md-7">
            <form class="form-horizontal" role="form" id="fo-program">
                <div class="form-group">
                    <input type="hidden" name="program_id" value="">
                    <label class="col-md-3">Nama Program</label>
                    <div class="col-md-9">
                        @php
                            $options= [
                                'placeholder' => 'Nama Progam',
                                'class' =>'form-control input-sm'
                            ];
                        @endphp
                        {!! Form::text('program', '', $options) !!}
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
            <table id="tbl-data" class="table table-bordered table-striped table-hover table-green">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 10%;">No</th>
                        <th class="text-center" style="width: 80%;">Nama Program</th>
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
                url: '{{ route('program.index') }}',
                colId: 'program_id',
                cols: [
                    { key: 'program', class: ''},
                ]
            });
        }).on('reset', '#fo-program', function(e) {
            $('input[name="program_id"]').val('');
        }).on('submit', '#fo-program', function(e) {
            e.preventDefault();
            let fo = $(this),
                data = fo.serializeArray(),
                btn = fo.find('button[type="submit"]');
            gAjax(btn.find('i'), {
                url: `{{ route('program.store') }}`,
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
            let url = `{{ route('program.show', ['program' => ':id']) }}`;
            url = url.replace(':id', b.attr('data-id'));
            gAjax(b.find('i'), {
                url: url,
                dataType: 'json',
                done: function(res) {
                    $('input[name="program_id"]').val(res.program_id);
                    $('input[name="program"]').val(res.program);
                }
            });
        }).on('click', '.btn-delete', function() {
            let b = $(this);
            let url = `{{ route('program.destroy', ['program' => ':id']) }}`;
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
