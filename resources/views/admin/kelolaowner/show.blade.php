@extends('layout.app')

@section('content')

<div class="row justify-content-center">
        <div class="col">
            <div class="card">

            {{-- CARD HEADER--}}
                <div class="card-header">
                    <strong><i class="cil-zoom"></i> Detail Informasi Pemilik</strong>
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">
                    <div class="form-group">
                        <div class='form-label'><strong> Nama Lengkap : </strong>{{ $users->nama }}</div>                       
                    </div>

                    <div class="form-group">
                        <div class='form-label'><strong> Tempat Lahir : </strong> {{ $users->tempat_lahir }}</div>
                    </div>

                    <div class="form-group">
                        <div class='form-label'><strong>Tanggal Lahir : </strong>{{ $users->tanggal_lahir }}</div>
                    </div>

                    <div class="form-group">
                        <div class='form-label'><strong> Alamat : </strong>{{ $users->alamat }}</div>
                    </div>

                    <div class="form-group">
                        <div class='form-label'><strong> No. HP : </strong>{{ $users->hp }}</div>
                    </div>

                    <div class="form-group">
                        <div class='form-label'><strong> E-mail : </strong>{{ $users->email}}</div>
                    </div>

                    <div class="form-group">
                        <div class='form-label'><strong> Username : </strong>{{ $users->username }}</div>
                    </div>
                    <div class="form-group"> 
                        <a class='btn btn-primary' href="{{ route('owners.index') }}">Kembali</a>
                    </div>
                </div>

                {{--CARD FOOTER--}}
                <div class="card-footer">

                </div>
            </div>
        </div>

</div>

@endsection