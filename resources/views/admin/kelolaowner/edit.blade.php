@extends('layout.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col">
            <div class="row">
                <div class="col-md-8">
                    <div class="card p-3">
                        @foreach($user as $users)
                        <form action="{{ route('owners.update', $users->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="nama">Nama:</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $users->nama }}">
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir:</label>
                                <input type="tempat" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ $users->tempat_lahir }}">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir:</label>
                                <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $users->tanggal_lahir }}">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat:</label>
                                <textarea class="form-control" id="alamat" name="alamat">{{ $users->alamat }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="nohp">No Hp:</label>
                                <input type="text" class="form-control" id="hp" name="hp" value="{{ $users->hp }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-md btn-primary">Submit</button>
                                <button type="reset" class="btn btn-md btn-danger">Cancel</button>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection