@extends('layout.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-10">
        <div class="card">
            {{-- CARD BODY--}}
            <div class="card-body row justify-content-center">
                <div class="col-8">
                    <h3 class="text-center mt-3 mb-4"><b>{{ strtoupper($users->nama) }}</b></h3>
                    <table width="100%" cellpadding="5">
                        <tr>
                            <td width="30%"><b>Nama Lengkap</b></td>
                            <td>:</td>
                            <td>{{ $users->nama }}</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Tempat Lahir</b></td>
                            <td>:</td>
                            <td>{{ $users->tempat_lahir }}</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Tanggal Lahir</b></td>
                            <td>:</td>
                            <td>{{ format_tgl_indonesia($users->tanggal_lahir) }}</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Alamat</b></td>
                            <td>:</td>
                            <td>{{ $users->alamat }}</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>No. HP</b></td>
                            <td>:</td>
                            <td>{{ $users->hp }}</td>
                        <tr>
                            <td width="30%"><b>E-Mail</b></td>
                            <td>:</td>
                            <td>{{ $users->email }}</td>
                        <tr>
                            <td width="30%"><b>Username</b></td>
                            <td>:</td>
                            <td>{{ $users->username }}</td>
                        </tr>
                    </table>
                    <div class="form-group mt-5"> 
                        <a class='btn btn-sm btn-primary' href="{{ route('pemilik.index') }}"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection