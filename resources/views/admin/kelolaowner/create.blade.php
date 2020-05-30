@extends('layout.app')

@section('content')

<div class="card">
        <div class="card-header">
            <h3><b><i class="cil-plus"></i> Tambah Pemilik</b></h3>
        </div>
        <div class="card-body">
            <form action="{{ route('owners.store') }}" method='POST'>
                {{ csrf_field() }}
                
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                </div>
                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir:</label>
                    <input type="tempat" class="form-control" id="tempat_lahir" name="tempat_lahir">
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir:</label>
                    <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <textarea class="form-control" id="alamat" name="alamat"></textarea>
                </div>
                <div class="form-group">
                    <label for="nohp">No Hp:</label>
                    <input type="text" class="form-control" id="hp" name="hp">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="Username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="text" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="konpass">Konfirmasi Password:</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-md btn-primary">
                    <input type="reset" class="btn btn-md btn-danger">
                </div>
            </form>

        </div>

        <div class="card-footer">
        </div>
    </div>

@endsection