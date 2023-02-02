@extends('layouts.modal', ['modalTitle' => 'Akun Profil', 'idForm' => 'fo-changePass', 'isLarge' => false])

@section('ModalBody')
    @php
        $options['class'] = 'form-control input-sm';
        $options['placeholder'] = 'Masukkan Nama';
    @endphp
    <div class="form-horizontal" role="form">
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-3 control-label">Nama</label>
                <div class="col-md-8">
                    {!! Form::hidden('id', $users->id) !!}
                    {!! Form::text('name', $users->name, $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Username</label>
                <div class="col-md-8">
                    @php
                        $options['placeholder'] = 'Masukkan Username (untuk login)';
                    @endphp
                    {!! Form::text('email', $users->email, $options) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Password</label>
                <div class="col-md-4">
                    @php
                        $options['placeholder'] = 'Masukkan Password (untuk login)';
                    @endphp
                    {!! Form::password('password', $options) !!}
                </div>
                <div class="col-md-4">
                    @php
                        $options['placeholder'] = 'Tulis Ulang password';
                    @endphp
                    {!! Form::password('password_confirmation', $options) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
