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
            @if(Auth::guard('admin')->check())
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-usulanUsaha-tab" data-toggle="pill" href="#custom-tabs-four-usulanUsaha" role="tab" aria-controls="custom-tabs-four-usulanUsaha" aria-selected="true">Usulan Usaha</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-usulanUpdateUsaha-tab" data-toggle="pill" href="#custom-tabs-four-usulanUpdateUsaha" role="tab" aria-controls="custom-tabs-four-usulanUpdateUsaha" aria-selected="true">Usulan Update Usaha</a>
            </li>
            @endif
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
                        <?php $i = 1; ?>
                        @foreach($usahas as $usaha)
                        @if($usaha->status == 1)
                            <tr>
                                <td>{{ $i++ }}</td>
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
                        @endif
                        @endforeach
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
            @if(Auth::guard('admin')->check())
            <div class="tab-pane fade" id="custom-tabs-four-usulanUsaha" role="tabpanel" aria-labelledby="custom-tabs-four-usulanUsaha-tab">
                <table class="table table-outline table-hover" id="tabelUsulanUsaha">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Usaha</th>
                            <th>Jenis Usaha</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($usahas as $usaha)
                        @if($usaha->status == 0)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $usaha->nama }}</td>
                                <td>{{ $usaha->jenis->nama }}</td>
                                <td class="text-center">
                                    <form action="{{ route('usulanUsaha.confirm') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $usaha->id }}">
                                        <input type="hidden" name="status" id="status-{{ $usaha->id }}">
                                        <a href="{{ route('usaha.show', [$usaha->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Detail</a>
                                        <button class="btn btn-sm btn-success" type="button" onclick="konfirm(this)" data-id="{{ $usaha->id }}" data-jenis="1"><i class="fas fa-check"></i> Konfirmasi</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                        @endforeach
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-usulanUpdateUsaha" role="tabpanel" aria-labelledby="custom-tabs-four-usulanUpdateUsaha-tab">
                <table class="table table-outline table-hover" id="tabelUsulanUpdate">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Usaha</th>
                            <th>Jenis Usaha</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($updates as $usaha)
                        @if($usaha->status == 0)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $usaha->nama }}</td>
                                <td>{{ $usaha->jenis->nama }}</td>
                                <td class="text-center">
                                    <form action="{{ route('usulanUsaha.konfirm') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $usaha->id }}">
                                        <input type="hidden" name="status" id="statusU-{{ $usaha->id }}">
                                        <a href="{{ route('usulanUsaha.detail', [$usaha->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Detail</a>
                                        <button class="btn btn-sm btn-success" type="button" onclick="konfirm(this)" data-id="{{ $usaha->id }}" data-jenis="0"><i class="fas fa-check"></i> Konfirmasi</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                        @endforeach
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
            @endif
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
    $("#tabelUsulanUsaha").DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                text: "<i class='fas fa-plus mr-2'></i>Tambah Data",
                action: function ( e, dt, node, config ) {
                    window.open("{{ route('usaha.create') }}", "_self");
                },
                className: 'btn-outline-primary mb-4 mt-2 invisible',
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary')
                }
            }
        ]
    });
    $("#tabelUsulanUpdate").DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                text: "<i class='fas fa-plus mr-2'></i>Tambah Data",
                action: function ( e, dt, node, config ) {
                    window.open("{{ route('usaha.create') }}", "_self");
                },
                className: 'btn-outline-primary mb-4 mt-2 invisible',
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

    function konfirm(e){
        let buttons = $('<div>')
        .append(createButton('btn btn-primary ml-2 confirmYes', '<i class="fas fa-check"></i> Accept', 'data-id="'+ $(e).data('id') +'"'))
        .append(createButton('btn btn-danger ml-2 confirmNo', '<i class="fas fa-times"></i> Reject', 'data-id="'+ $(e).data('id') +'"'))
        .append(createButton('btn btn-secondary ml-2 confirmCancel', 'Cancel'));

        Swal.fire({
            title: "Konfirmasi Usulan Usaha",
            html: buttons,
            icon: 'question',
            text: '',
            showConfirmButton: false,
            showCancelButton: false
        })
    }

    function createButton(kelas, text, data='') {
        return $('<button class="'+kelas+'" '+data+'>' + text + '</button>');
    }

    $(document).on('click', '.confirmYes', function(){
        let id = $(this).data('id');
        if($(this).data('jenis') == 0){
            $("#statusU-"+id).val(1);
            $("#statusU-"+id).parent().submit();
        }else{
            console.log('ini');
            $("#status-"+id).val(1);
            $("#status-"+id).parent().submit();
        }
    });

    $(document).on('click', '.confirmNo', function(){
        let id = $(this).data('id');
        if($(this).data('jenis') == 0){
            $("#statusU-"+id).val(2);
            $("#statusU-"+id).parent().submit();
        }else{
            $("#status-"+id).val(2);
            $("#status-"+id).parent().submit();
        }
    });

    $(document).on('click', '.confirmCancel', function(){
        swal.close();
    })
</script>
@endsection