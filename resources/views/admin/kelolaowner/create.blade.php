@extends('layout.app')

@section('content')
<div class="row justify-content-center">
    <div class="card col-10">
        <div class="card-body">
            <form action="{{ route('owners.store') }}" method='POST' class="mt-3 mb-3">
                {{ csrf_field() }}
                {!! formInputRow('Nama Lengkap', 'text', 'nama', 'nama lengkap', '', old('nama'), $errors->first('nama')) !!}
                {!! formInputCol('Tempat Lahir', 'text', 'tempat_lahir', 'tempat lahir', '', old('tempat_lahir'), $errors->first('tempat_lahir'), 'Tanggal Lahir', 'date', 'tanggal_lahir', '', '', old('tanggal_lahir'), $errors->first('tanggal_lahir')) !!}
                <div class="row justify-content-center">
                    <div class="col-8 form-group">
                        <label for="alamat">Alamat:</label>
                        <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat ...">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="text-danger text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                {!! formInputCol('No. HP', 'text', 'hp', 'No. HP', '', old('hp'), $errors->first('hp'), 'E-Mail', 'email', 'email', 'E-Mail', '', old('email'), $errors->first('email')) !!}
                {!! formInputRow('Username*', 'text', 'username', 'username', 'required', old('username'), $errors->first('username')) !!}
                {!! formInputCol('Password*', 'password', 'password', 'Password', 'required', old('password'), $errors->first('password'), 'Konfirmasi Password*', 'password', 'password_confirmation', 'kembali password', 'required', old('password_confirmation'), $errors->first('password_confirmation')) !!}
                <div class="row justify-content-center mt-4">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <a href="{{ url('/owners') }}" class="btn btn-warning float-left"><i class="fas fa-arrow-left"></i> Kembali</a>
                        <button type="reset" class="btn btn-secondary float-right"><i class="fas fa-undo"></i> Reset</button>
                        <button type="submit" class="btn btn-primary float-right mr-2"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                    <div class="col-2"></div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection