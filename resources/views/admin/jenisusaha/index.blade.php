@extends('layout.app')
<!-- @section('script')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
	$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection -->
@section('content')
<div class="row">
    <section class="col-12 connectedSortable">
        <div class="card">

            <div class="card-body">
                <div class="container-fluid">

    <div class="row">

        <section class="col-lg-12 connectedSortable">



                    <h3 class="card-title">

                    </h3>

               <!-- Button trigger modal -->
<button type="button" style="float: right; margin-bottom: 20px;" class="btn btn-primary" data-toggle="modal" data-target="#modalJenisUsaha" id="tambahJenisUsaha"> <i class="fas fa-plus"></i>
  Tambah data 
</button>

<!-- Modal -->
<div class="modal fade" id="modalJenisUsaha" tabindex="-1" role="dialog" aria-labelledby="modalJenisUsahaLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <form action="{{ route('jenisusaha.store') }}" method="post" id="formJenisUsaha">

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

                

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float: left; margin-right:240px; ">Tutup</button>
        			<button type="submit" class="btn btn-primary">Simpan</button>
       				<button  type=reset class="btn btn-danger">Reset</button>

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

                                                         <form style="display: inline" method="POST" action="{{ route('jenisusaha.destroy', $jenisusaha->id) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" onclick="confirm('Yakin?')" class="btn btn-danger btn-xs" value="Delete user"><i class="fa fa-trash"></i> Delete</button>
                                        </form>

                                                    </td>

                                                </tr>

                                            @endforeach

                                        </tbody>

                                        <tfoot></tfoot>
                                    </div>

                                    </table>

                           
	<script>

    $("#tabelJenisUsaha").DataTable();

    $("#tambahJenisUsaha").click(function(){

        $("#modalJenisUsahaLabel").html('Tambah Jenis Usaha');

        $("#formJenisUsaha").attr('action', "{{ route('jenisusaha.store') }}")

        $("#nama").val('');


        $("#nama").prop('required',true);

    

        $("#inputJenisUsaha").show();

        $("#modalJenisUsaha").modal();

    });
   
    $(".editJenisUsaha").click(function(e){


        let id = $(e.target).data('id');

        let nama = $(e.target).data('nama');

      
        $("#modalJenisUsahaLabel").html('Edit '+nama);

        $("#formJenisUsaha").attr('action', "{{ route('jenisusaha.update', ['id' => $jenisusaha->id]) }}")

        $("#nama").val(nama);


        $("#id_edit").val(id);

        $("#nama").prop('required',true);

  

        $("#inputJenisUsaha").show();



        $("#modalJenisUsaha").modal();

    });
    

</script>
              

        </section>

    </div>

</div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('modal')

<!-- Modal JenisUsaha -->


@endsection



@section('js')


   

@endsection