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
    var markers = [];

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: parseFloat("{{ $latlng[1] }}"), lng: parseFloat("{{ $latlng[0] }}") },
            zoom: 16
        });
        infoWindow = new google.maps.InfoWindow;
        addMarker(new google.maps.LatLng(parseFloat("{{ $latlng[1] }}"),parseFloat("{{ $latlng[0] }}")));

        // Add marker on click
        map.addListener('click', function(event) {
            let lat = event.latLng.lat();
            let lng = event.latLng.lng();
            $("#latitude").val(lat);
            $("#longitude").val(lng);
            deleteMarkers();
            addMarker(event.latLng);
        });
    }

    // Adds a marker to the map and push to the array.
    function addMarker(location) {
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
        map.setCenter(location);
        markers.push(marker);
    }

    // Sets the map on all markers in the array.
    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    // Removes the markers from the map, but keeps them in the array.
    function clearMarkers() {
        setMapOnAll(null);
    }

    // Shows any markers currently in the array.
    function showMarkers() {
        setMapOnAll(map);
    }

    // Deletes all markers in the array by removing references to them.
    function deleteMarkers() {
        clearMarkers();
        markers = [];
    }

</script>
@endsection

@section('content')
<form action="{{ route('usaha.update', $usaha->id) }}" method="post" enctype="multipart/form-data">
    <div class="row">
        @csrf
        @method('PUT')
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    {!! formInputRow('Nama Usaha*', 'text', 'nama', 'nama usaha', 'required', $usaha->nama, $errors->first('nama'), 12) !!}
                    {!! formSelect('Jenis Usaha*', 'jenis_usaha_id', $jenisUsahas, $usaha->jenis_usaha_id) !!}
                    {!! formInputRow('Nama Pemilik', 'text', 'pemilik', 'nama pemilik', '', $usaha->pemilik, $errors->first('pemilik'), 12) !!}
                    {!! formInputRow('No. HP', 'text', 'hp', 'No. HP', '', $usaha->hp, $errors->first('hp'), 12) !!}
                    {!! formInputCol('Jam Buka', 'time', 'jam_buka', '', '', $usaha->jam_buka, $errors->first('jam_buka'), 'Jam Tutup', 'time', 'jam_tutup', '', '', $usaha->jam_tutup, $errors->first('jam_tutup'), 6) !!}
                    {!! formInputRow('Barang/Jasa tersedia*', 'text', 'barang_jasa', 'Barang/Jasa', 'required', $usaha->barang_jasa, $errors->first('barang_jasa'), 12) !!}
                    {!! formText('Alamat', 'alamat', 'required', $usaha->alamat, $errors->first('alamat'), 12) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center mb-3">
                        <div class="col-6">
                            <label for="foto">Dokumentasi:</label>
                            <div class="text-center">
                                <img src="{{ url($usaha->foto) }}" alt="" height="120">
                            </div>
                        </div>
                        <div class="col-6 form-group">
                            <label for="foto">Dokumentasi*:</label>
                            <div class="custom-file">
                                <input type="file" name="foto" id="foto" class="custom-file-input @error('foto') is-invalid @enderror">
                                <label for="foto" class="custom-file-label"></label>
                            </div>
                            @error('foto')
                            <p class="text-danger text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    {!! formInputCol('Latitude', 'number', 'latitude', 'latitude', 'required', $latlng[1], $errors->first('latitude'), 'Longitude', 'number', 'longitude', 'longitude', 'required', $latlng[0], $errors->first('longitude'), 6, "step=0.00000000000000001", "step=0.00000000000000001") !!}
                    <div id="map" style="height: 322px;" class="mb-4"></div>
                    {!! formText('Keterangan Tambahan', 'ket', 'required', $usaha->ket, $errors->first('ket'), 12) !!}
                    <div class="row justify-content-center mt-4">
                        <div class="col-12">
                            <a href="{{ url('/usaha') }}" class="btn btn-warning float-left"><i class="fas fa-arrow-left"></i> Kembali</a>
                            <button type="reset" class="btn btn-secondary float-right"><i class="fas fa-undo"></i> Reset</button>
                            <button type="submit" class="btn btn-primary float-right mr-2"><i class="fas fa-save"></i> Update</button>
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

    $("#latitude").add("#longitude").on('input', function(){
        let lat = $("#latitude").val();
        let lng = $("#longitude").val();

        if((lat != '' && lng != '') ){
            deleteMarkers();
            addMarker(new google.maps.LatLng(lat,lng));
        }
    });
</script>
@endsection