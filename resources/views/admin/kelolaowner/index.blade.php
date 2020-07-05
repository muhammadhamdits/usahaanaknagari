@extends('layout.app')

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
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($users as $user)
                        @if($user->status == 1)
                            <tr>
                                <td>
                                    {{ $i++ }}
                                </td>
                                <td>
                                    {{ $user->username }}
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('pemilik.destroy', $user->id) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a href="{{ route('pemilik.show', [$user->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Detail</a>
                                        <a href="{{ route('pemilik.edit', [$user->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
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
            <div class="tab-pane fade" id="custom-tabs-four-usulanPemilik" role="tabpanel" aria-labelledby="custom-tabs-four-usulanPemilik-tab">
                <table class="table table-outline table-hover" id="tabelUsulanPemilik">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th class="text-center">Tanda Pengenal</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($users as $user)
                        @if($user->status == 0)
                            <tr>
                                <td>
                                    {{ $i++ }}
                                </td>
                                <td>
                                    {{ $user->username }}
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary lihatFoto" data-toggle="modal" data-target="#modalPengenal" data-pengenal="{{ $user->tanda_pengenal }}">
                                        <i class="fas fa-file"></i> Lihat
                                    </button>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('usulanPemilik.confirm') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <input type="hidden" name="status" id="status-{{ $user->id }}">
                                        <a href="{{ route('pemilik.show', [$user->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Detail</a>
                                        <button class="btn btn-sm btn-success" type="button" onclick="konfirm(this)" data-id="{{ $user->id }}"><i class="fas fa-check"></i> Konfirmasi</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                        @endforeach
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- /.card -->
    <!-- Modal -->
    <div class="modal fade" id="modalPengenal" tabindex="-1" role="dialog" aria-labelledby="modalPengenalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <img src="" alt="" id="fotoPengenal" width="100%" class="mt-4">
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $("#tabelDataPemilik").DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                text: "<i class='fas fa-plus mr-2'></i>Tambah Data",
                action: function ( e, dt, node, config ) {
                    window.open("{{ route('pemilik.create') }}", "_self");
                },
                className: 'btn-outline-primary mb-4 mt-2',
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary')
                }
            }
        ]
    });
    $("#tabelUsulanPemilik").DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                text: "<i class='fas fa-plus mr-2'></i>Tambah Data",
                action: function ( e, dt, node, config ) {
                    window.open("{{ route('pemilik.create') }}", "_self");
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
            title: "Konfirmasi Usulan Pemilik",
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
        $("#status-"+id).val(1);
        $("#status-"+id).parent().submit();
    });

    $(document).on('click', '.confirmNo', function(){
        let id = $(this).data('id');
        $("#status-"+id).val(2);
        $("#status-"+id).parent().submit();
    });

    $(document).on('click', '.confirmCancel', function(){
        swal.close();
    });

    $(document).on('click', '.lihatFoto', function(){
        let src = $(this).data('pengenal');
        $("#fotoPengenal").attr('src', src);
    });
</script>
@endsection