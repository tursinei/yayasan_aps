@extends('layouts.master')

@section('title', 'Users')
{{-- @section('subTitle', 'Welcome, this page after login') --}}

@section('content')
    <div class="row">
        <div class="col-md-8">
            <form id="fo-users" class="form-horizontal" role="form">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama</label>
                        <div class="col-md-8">
                            <input type="hidden" name="id" id="iduser" value="">
                            <input type="text" name="name" id="nama" class="form-control input-sm"
                                placeholder="Nama Lengkap">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Username</label>
                        <div class="col-md-8">
                            <input type="text" name="email" id="username" class="form-control input-sm"
                                placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Password</label>
                        <div class="col-md-4">
                            <input type="password" name="password" id="password" class="form-control input-sm"
                                placeholder="Password">
                        </div>
                        <div class="col-md-4">
                            <input type="password" name="password_confirmation" id="nama" class="form-control input-sm"
                                placeholder="Tulis Ulang password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">User Sebagai</label>
                        <div class="col-md-8">
                            <select name="peran" id="peran" class="form-control input-sm">
                                <option value="">--Pilih Peran User--</option>
                                @foreach ($perans as $key => $peran)
                                    <option value="{{ $key }}">{{ ucfirst($peran) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-11 text-right">
                            <button type="reset" class="btn btn-sm blue">Reset</button>
                            <button type="submit" class="btn btn-sm green"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12">

            <table id="tbl-data" class="table table-bordered table-striped table-hover table-green">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th class="text-center" style="width: 30%;">Nama</th>
                        <th class="text-center" style="width: 30%;">Username</th>
                        <th class="text-center" style="width: 15%;">Peran</th>
                        <th class="text-center" style="width: 10%;">Di Buat</th>
                        <th class="text-center" style="width: 10%;">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" class="text-center">Loading data... <i class="fa fa-spin fa-spinner"></i>
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
                url: '{{ route('user.index') }}',
                colId: 'id',
                cols: [
                    { key: 'name'},
                    { key: 'email'},
                    { key: 'peran', class: 'text-center'},
                    { key: 'created_at', class: 'text-center' },
                ]
            });
        }).on('reset', '#fo-users', function(e) {
            $('input[name="id"]').val('');
        }).on('submit', '#fo-users', function(e) {
            e.preventDefault();
            let fo = $(this),
                data = fo.serializeArray(),
                btn = fo.find('button[type="submit"]');
            gAjax(btn.find('i'), {
                url: `{{ route('user.store') }}`,
                dataType: 'JSON',
                data: data,
                type: 'POST',
                done: function(e) {
                    fo[0].reset();
                    msgSuccess(e.message);
                    $('#tbl-data').tPaginate('reload');
                }
            });
        }).on('click', '.btn-update', function name(e) {
            let b = $(this);
            let url = `{{ route('user.show', ['user' => ':id']) }}`;
            url = url.replace(':id', b.attr('data-id'));
            gAjax(b.find('i'), {
                url: url,
                dataType: 'JSON',
                done: function(res) {
                    $('#iduser').val(res.id);
                    $('#nama').val(res.name).focus();
                    $('#username').val(res.email);
                    $('#peran').val(res.peran);
                }
            });
        }).on('click', '.btn-delete', function() {
            let b = $(this);
            let url = `{{ route('user.destroy', ['user' => ':id']) }}`;
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
