@extends('layout.app')

@section('content')
<div class="row justify-content-center">
    <div class="card col-10">
        <div class="card-body">
            @foreach($user as $users)
            <form action="/profile/{{ $users->id }}" method="post" class="mt-3 mb-3">
                {{ csrf_field() }}
                {{ method_field('put') }}
                {!! formInputRow('Nama Lengkap', 'text', 'nama', 'nama lengkap', '', $users->nama, $errors->first('nama')) !!}
                {!! formInputCol('Tempat Lahir', 'text', 'tempat_lahir', 'tempat lahir', '', $users->tempat_lahir, $errors->first('tempat_lahir'), 'Tanggal Lahir', 'date', 'tanggal_lahir', '', '', $users->tanggal_lahir, $errors->first('tanggal_lahir')) !!}
                <div class="row justify-content-center">
                    <div class="col-8 form-group">
                        <label for="alamat">Alamat:</label>
                        <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat ...">{{ $users->alamat }}</textarea>
                        @error('alamat')
                            <p class="text-danger text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                {!! formInputRow('No. HP', 'text', 'hp', 'No. HP', '', $users->hp, $errors->first('hp')) !!}
                {!! formInputRow('E-Mail', 'text', 'email', 'E-Mail', '', $users->email, $errors->first('email')) !!}
                <div class="row justify-content-center mt-4">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <a href="{{ '/profile' }}" class="btn btn-warning float-left"><i class="fas fa-arrow-left"></i> Kembali</a>
                        <button type="reset" class="btn btn-secondary float-right"><i class="fas fa-undo"></i> Reset</button>
                        <button type="submit" class="btn btn-primary float-right mr-2"><i class="fas fa-save"></i> Update</button>
                    </div>
                    <div class="col-2"></div>
                </div>
            </form>
            @endforeach
        </div>
    </div>
</div>
@endsection