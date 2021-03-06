@extends('../layout/app')

@section('css')
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
@endsection

@section('content')
<div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-four-dataUsaha-tab" data-toggle="pill" href="#custom-tabs-four-dataUsaha" role="tab" aria-controls="custom-tabs-four-dataUsaha" aria-selected="false">Data Usaha</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-usulanUsaha-tab" data-toggle="pill" href="#custom-tabs-four-usulanUsaha" role="tab" aria-controls="custom-tabs-four-usulanUsaha" aria-selected="true">Usulan Usaha</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-usulanUpdateUsaha-tab" data-toggle="pill" href="#custom-tabs-four-usulanUpdateUsaha" role="tab" aria-controls="custom-tabs-four-usulanUpdateUsaha" aria-selected="true">Usulan Update Usaha</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-four-dataUsaha" role="tabpanel" aria-labelledby="custom-tabs-four-dataUsaha-tab">
                <table class="table table-outline table-hover" id="tabelDataUsaha">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Usaha</th>
                            <th>Jenis Usaha</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usahas as $usaha)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $usaha->nama }}</td>
                                <td>{{ $usaha->jenis->nama }}</td>
                                <td class="text-center">
                                    <form action="{{ route('usaha.destroy', $usaha->id) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a href="{{ route('usaha.show', [$usaha->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Detail</a>
                                        <a href="{{ route('usaha.edit', [$usaha->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                        <button class="btn btn-sm btn-danger" type="button" onclick="hapus(this)"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-usulanUsaha" role="tabpanel" aria-labelledby="custom-tabs-four-usulanUsaha-tab">
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-usulanUpdateUsaha" role="tabpanel" aria-labelledby="custom-tabs-four-usulanUpdateUsaha-tab">
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $("#tabelDataUsaha").DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                text: "<i class='fas fa-plus mr-2'></i>Tambah Data",
                action: function ( e, dt, node, config ) {
                    window.open("{{ route('usaha.create') }}", "_self");
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