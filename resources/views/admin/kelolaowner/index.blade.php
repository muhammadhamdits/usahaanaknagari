@extends('layout.app')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/r-2.2.5/sp-1.1.1/datatables.min.css"/>
<style>
.dataTables_filter {
text-align: left !important;
}
div.dt-buttons {
    float: right !important;
}
</style>
@endsection

@section('script')
<script>
    $('.dataTables_filter').addClass('pull-left');
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection

@section('content')
<div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-four-dataPemilik-tab" data-toggle="pill" href="#custom-tabs-four-dataPemilik" role="tab" aria-controls="custom-tabs-four-dataPemilik" aria-selected="false">Data Pemilik</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-usulanPemilik-tab" data-toggle="pill" href="#custom-tabs-four-usulanPemilik" role="tab" aria-controls="custom-tabs-four-usulanPemilik" aria-selected="true">Usulan Pemilik</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-four-dataPemilik" role="tabpanel" aria-labelledby="custom-tabs-four-dataPemilik-tab">
                <table class="table table-outline table-hover" id="tabelDataPemilik">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $user->username }}
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('owners.destroy', $user->id) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a href="{{ route('owners.show', [$user->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Detail</a>
                                        <a href="{{ route('owners.edit', [$user->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                        <button class="btn btn-sm btn-danger" type="button" onclick="hapus(this)"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-usulanPemilik" role="tabpanel" aria-labelledby="custom-tabs-four-usulanPemilik-tab">
            </div>
        </div>
    </div>
    <!-- /.card -->
</div>

@endsection

@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/r-2.2.5/sp-1.1.1/datatables.min.js"></script>
<script>
    $("#tabelDataPemilik").DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                text: "<i class='fas fa-plus mr-2'></i>Tambah Data",
                action: function ( e, dt, node, config ) {
                    window.open("{{ route('owners.create') }}", "_self");
                },
                className: 'btn-outline-primary mb-4 mt-2',
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary')
                }
            }
        ]
    });
    $('div.dataTables_filter input').addClass('mt-2');

    function hapus(e){
        Swal.fire({
            title: 'Yakin ingin menghapus data ini?',
            text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
                if(result.value == true){
                    $(e).parent().submit();
                }else {
                    Swal.fire({
                        title: 'Canceled',
                        html: 'Data tidak jadi dihapus',
                        icon: 'error',
                        timer: 1500,
                        timerProgressBar: true,
                        onBeforeOpen: () => {
                            timerInterval = setInterval(() => {
                            const content = Swal.getContent()
                            if (content) {
                                const b = content.querySelector('b')
                                if (b) {
                                b.textContent = Swal.getTimerLeft()
                                }
                            }
                            }, 100)
                        },
                        onClose: () => {
                            clearInterval(timerInterval)
                        }
                    })
                }
            })
    }
</script>
@endsection