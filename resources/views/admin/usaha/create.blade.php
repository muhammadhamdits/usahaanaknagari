{{-- dd($jenisUsahas) --}}
@extends('../layout/app')

@section('css')
<style>
.card .select2-selection{
    width: 100% !important;
    height: calc(2.25rem + 2px) !important;
}
.card .select2-selection__arrow{
    height: calc(2.25rem + 2px) !important;
    right: 8px !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered{
    line-height: 24px !important;
}
</style>
@endsection

@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=&v=weekly" defer></script>
<script>
    var map;
    function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -0.9525199, lng: 100.4226954 },
        zoom: 8
    });
    }
</script>
@endsection

@section('content')
<form action="{{ route('usaha.store') }}" method="post">
    <div class="row">
        @csrf
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    {!! formInputRow('Nama Usaha*', 'text', 'nama', 'nama usaha', 'required', old('nama'), $errors->first('nama'), 12) !!}
                    {!! formSelect('Jenis Usaha*', 'jenis_usaha_id', $jenisUsahas) !!}
                    {!! formInputRow('Nama Pemilik', 'text', 'pemilik', 'nama pemilik', '', old('pemilik'), $errors->first('pemilik'), 12) !!}
                    {!! formInputRow('No. HP', 'text', 'hp', 'No. HP', '', old('hp'), $errors->first('hp'), 12) !!}
                    {!! formInputCol('Jam Buka', 'time', 'jam_buka', '', '', old('jam_buka'), $errors->first('jam_buka'), 'Jam Tutup', 'time', 'jam_tutup', '', '', old('jam_tutup'), $errors->first('jam_tutup'), 6) !!}
                    {!! formInputRow('Barang/Jasa tersedia*', 'text', 'barang_jasa', 'Barang/Jasa', 'required', old('barang_jasa'), $errors->first('barang_jasa'), 12) !!}
                    {!! formText('Alamat', 'alamat', 'required', old('alamat'), $errors->first('alamat'), 12) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center mb-3">
                        <div class="col-12 form-group">
                            <label for="foto">Dokumentasi*:</label>
                            <div class="custom-file">
                                <input type="file" name="foto" id="foto" class="custom-file-input @error('foto') is-invalid @enderror" value="{{ old('foto') }}" required>
                                <label for="foto" class="custom-file-label">Pilih file</label>
                            </div>
                            @error('foto')
                            <p class="text-danger text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    {!! formInputCol('Latitude', 'text', 'latitude', 'latitude', 'required', old('latitude'), $errors->first('latitude'), 'Longitude', 'text', 'longitude', 'longitude', 'required', old('longitude'), $errors->first('longitude'), 6) !!}
                    <div id="map" style="height: 322px;" class="mb-4"></div>
                    {!! formText('Keterangan Tambahan', 'ket', 'required', old('ket'), $errors->first('ket'), 12) !!}
                    <div class="row justify-content-center mt-4">
                        <div class="col-12">
                            <a href="{{ url('/usaha') }}" class="btn btn-warning float-left"><i class="fas fa-arrow-left"></i> Kembali</a>
                            <button type="reset" class="btn btn-secondary float-right"><i class="fas fa-undo"></i> Reset</button>
                            <button type="submit" class="btn btn-primary float-right mr-2"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('js')
<script>
    $("#jenis_usaha_id").select2();
    $("#foto").change(function(){
        let namaFile = $(this).val();
        namaFile = namaFile.split('\\');
        namaFile = namaFile[namaFile.length-1];
        $(".custom-file-label").html(namaFile);
    });
</script>
@endsection