<?php
    $judul = "Daftar Sebagai Pemilik";
?>

@extends('../layout/app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-8 form-group">
                                <label for="nama">Nama Lengkap*:</label>
                                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap ..." required>
                                @error('nama')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-4 form-group">
                                <label for="tempat_lahir">Tempat Lahir:</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" placeholder="Masukkan Tempat Lahir ...">
                                @error('tempat_lahir')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-4 form-group">
                                <label for="tanggal_lahir">Tanggal Lahir:</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" placeholder="Masukkan Tempat Lahir ...">
                                @error('tanggal_lahir')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-8 form-group">
                                <label for="alamat">Alamat:</label>
                                <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" placeholder="Masukkan Alamat ..."></textarea>
                                @error('alamat')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-4 form-group">
                                <label for="hp">No. HP:</label>
                                <input type="text" name="hp" id="hp" class="form-control @error('hp') is-invalid @enderror" value="{{ old('hp') }}" placeholder="Masukkan No. HP ...">
                                @error('hp')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-4 form-group">
                                <label for="email">E-Mail*:</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukkan E-Mail ..." required>
                                @error('email')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-8 form-group">
                                <label for="tanda_pengenal">Tanda Pengenal*:</label>
                                <div class="custom-file">
                                    <input type="file" name="tanda_pengenal" id="tanda_pengenal" class="custom-file-input @error('tanda_pengenal') is-invalid @enderror" value="{{ old('tanda_pengenal') }}" required>
                                    <label for="tanda_pengenal" class="custom-file-label">Pilih file</label>
                                </div>
                                @error('tanda_pengenal')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-8 form-group">
                                <label for="username">Username*:</label>
                                <input type="username" name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan username ..." required>
                                @error('username')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-4 form-group">
                                <label for="password">Password*:</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password ..." required>
                                @error('password')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-4 form-group">
                                <label for="password-confirm">Konfirmasi Password*:</label>
                                <input type="password" name="password_confirmation" id="password-confirm" class="form-control @error('password-confirm') is-invalid @enderror" value="{{ old('password-confirm') }}" placeholder="Masukkan konfirmasi password ..." required>
                                @error('password-confirm')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <a href="{{ url()->previous() }}" class="btn btn-warning float-left"><i class="fas fa-arrow-left"></i> Kembali</a>
                                <button type="reset" class="btn btn-secondary float-right"><i class="fas fa-undo"></i> Reset</button>
                                <button type="submit" class="btn btn-primary float-right mr-2"><i class="fas fa-save"></i> Daftar</button>
                            </div>
                            <div class="col-2"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $("#tanda_pengenal").change(function(){
        let namaFile = $(this).val();
        namaFile = namaFile.split('\\');
        namaFile = namaFile[namaFile.length-1];
        $(".custom-file-label").html(namaFile);
    });
</script>
@endsection