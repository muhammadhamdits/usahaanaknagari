@extends('layout.app')

@section('content')

<div class="card">
       
        <div class="card-header">
            <strong>Kelola Data Pemilik</strong>
        </div>
        <div class="m-3">
            <a href="{{ route('owners.index') }}" class="mr-3"> Data Pemilik </a>
            <a href="#"> Usulan Pemilik </a>
        </div>
        <div>
            <a class="m-3" href="{{ route('owners.create') }}">Tambah Data</a>
        </div>
        <div class="card-body">
            <table class="table table-outline table-hover">
                <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>
                            {{ $no }}
                        </td>
                        <td>
                            {{ $user->username }}
                        </td>
                        <td>
                            <form action="{{ route('owners.destroy', $user->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <a href="{{ route('owners.show', [$user->id]) }}" class="btn btn-sm btn-secondary">Detail</a>
                                <a href="{{ route('owners.edit', [$user->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Belum ada Mata Kuliah</td>
                    </tr>
                {{ $no++ }}
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">

        </div>

    </div>
@endsection