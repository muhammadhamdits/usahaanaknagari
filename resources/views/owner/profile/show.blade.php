@extends('layout.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-10">
        <div class="card">
            {{-- CARD BODY--}}
            <div class="card-body row justify-content-center">
                <div class="col-8">
                    <h3 class="text-center mt-3 mb-4"><b>{{ strtoupper($user->nama) }}</b></h3>
                    <table width="100%" cellpadding="5">
                        <tr>
                            <td width="30%"><b>Nama Lengkap</b></td>
                            <td>:</td>
                            <td>{{ $user->nama }}</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Tempat Lahir</b></td>
                            <td>:</td>
                            <td>{{ $user->tempat_lahir }}</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Tanggal Lahir</b></td>
                            <td>:</td>
                            <td>{{ format_tgl_indonesia($user->tanggal_lahir) }}</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Alamat</b></td>
                            <td>:</td>
                            <td>{{ $user->alamat }}</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>No. HP</b></td>
                            <td>:</td>
                            <td>{{ $user->hp }}</td>
                        <tr>
                            <td width="30%"><b>E-Mail</b></td>
                            <td>:</td>
                            <td>{{ $user->email }}</td>
                        <tr>
                            <td width="30%"><b>Username</b></td>
                            <td>:</td>
                            <td>{{ $user->username }}</td>
                        </tr>
                    </table>
                    <div class="form-group mt-5"> 
                        <a class='btn btn-sm btn-primary' href="{{ '/' }}"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                        <a class='btn btn-sm btn-warning float-right' href="/profile/{{ $user->id}}/edit"><i class="fas fa-edit mr-1"></i> Ubah Profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection