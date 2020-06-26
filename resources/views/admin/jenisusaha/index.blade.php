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
<div class="row">
    <section class="col-12 connectedSortable">
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <section class="col-lg-12 connectedSortable">
                            <h3 class="card-title"></h3>
                            <!-- Modal -->
                            <div class="modal fade" id="modalJenisUsaha" tabindex="-1" role="dialog" aria-labelledby="modalJenisUsahaLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('jenisUsaha.store') }}" method="post" id="formJenisUsaha">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalJenisUsahaLabel">Tambah Data Jenis Usaha</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div id="inputJenisUsaha">
                                                    <div class="form-group">
                                                        <label for="nama">Jenis Usaha :</label>
                                                        <input type="hidden" name="id_edit" id="id_edit">
                                                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan jenis usaha ..." required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="modal-footer d-flex">
                                                <!-- <div class="row justify-content-center"> -->
                                                    <!-- <div class="col-12"> -->
                                                        <button type="button" class="btn btn-secondary p-2 mr-auto" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
                                                        <button type="submit" class="btn btn-primary p-2 mr-2"><i class="fas fa-save"></i> Simpan</button>
                                                        <button  type=reset class="btn btn-danger p-2"><i class="fas fa-undo"></i> Reset</button>
                                                    <!-- </div> -->
                                                <!-- </div> -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content p-0">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-striped table-hover table-bordered text-center" id="tabelJenisUsaha">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th class="text-left">Nama Jenis Usaha</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($jenisusahas as $jenisusaha)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td class="text-left">{{ $jenisusaha->nama }}</td>
                                                    <td>
                                                        <button class="btn btn-warning btn-sm editJenisUsaha" data-id="{{ $jenisusaha->id }}" data-nama="{{ $jenisusaha->nama }}" >
                                                            <i class="fas fa-edit" data-id="{{ $jenisusaha->id }}" data-nama="{{ $jenisusaha->nama }}"> Edit</i>
                                                        </button>

                                                        <form style="display: inline" method="POST" action="{{ route('jenisUsaha.destroy', $jenisusaha->id) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="button" onclick="hapus(this)" class="btn btn-danger btn-sm" value="Delete user"><i class="fa fa-trash"></i> Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                        <tfoot></tfoot>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


                           

              



@endsection

@section('js')
<script>
    $("#tabelJenisUsaha").DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                text: "<i class='fas fa-plus mr-2'></i>Tambah Data",
                className: 'btn-outline-primary mb-4 mt-2 tambahData',
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary');
                    $(node).attr('data-toggle', 'modal');
                    $(node).attr('data-target', '#modalJenisUsaha');
                    $(node).attr('onclick', 'tambahJenisUsaha()');
                }
            }
        ]
    });
    $('div.dataTables_filter input').addClass('mt-2');

    function tambahJenisUsaha(){
        $("#modalJenisUsahaLabel").html('Tambah Jenis Usaha');
        $("#formJenisUsaha").attr('action', "{{ route('jenisUsaha.store') }}")
        $(".methodEdit").remove();
        $("#nama").val('');
        $("#nama").prop('required',true);
        $("#inputJenisUsaha").show();
        $("#modalJenisUsaha").modal();
    }
   
    $(".editJenisUsaha").click(function(e){
        let id = $(e.target).data('id');
        let nama = $(e.target).data('nama');
        $("#modalJenisUsahaLabel").html('Edit '+nama);
        $("#formJenisUsaha").attr('action', "/jenisUsaha/"+id);
        $("#formJenisUsaha").prepend("<input type='hidden' name='_method' value='PUT' class='methodEdit'>");
        $("#nama").val(nama);
        $("#id_edit").val(id);
        $("#nama").prop('required',true);
        $("#inputJenisUsaha").show();
        $("#modalJenisUsaha").modal();
    });

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