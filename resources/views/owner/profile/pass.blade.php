@extends('layout.app')

@section('content')
<div class="row justify-content-center">
    <div class="card col-10">
        <div class="card-body">
            <form action="{{ route('owner.profile.changePass') }}" method="post" class="mt-3 mb-3">
                {{ csrf_field() }}
                {!! formInputRow('Password Lama*', 'password', 'oldpass', 'password lama', 'required', '', $errors->first('oldpass')) !!}
                {!! formInputRow('Password Baru*', 'password', 'password', 'password baru', 'required', '', $errors->first('password')) !!}
                {!! formInputRow('Konfirmasi Password Baru*', 'password', 'password_confirmation', 'konfirmasi password baru', 'required', '', $errors->first('password_confirmation')) !!}
                <div class="row justify-content-center mt-4">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <a href="{{ url()->previous() }}" class="btn btn-warning float-left"><i class="fas fa-arrow-left"></i> Kembali</a>
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