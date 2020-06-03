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
            center: { lat: parseFloat("{{ $latlng[1] }}"), lng: parseFloat("{{ $latlng[0] }}") },
            zoom: 16
        });
        infoWindow = new google.maps.InfoWindow;
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(parseFloat("{{ $latlng[1] }}"),parseFloat("{{ $latlng[0] }}")),
            map: map
        });
    }
</script>
@endsection

@section('content')
<form action="{{ route('usaha.store') }}" method="post" enctype="multipart/form-data">
    <div class="row">
        @csrf
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="nama">Nama Usaha</label>
                            <p class="ml-3">{{ $usaha->nama }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="jenis">Jeis Usaha</label>
                            <p class="ml-3">{{ $usaha->jenis->nama }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="pemilik">Pemilik Usaha</label>
                            <p class="ml-3">{{ $usaha->pemilik }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="hp">No. HP</label>
                            <p class="ml-3">{{ $usaha->hp }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="jam_buka">Jam Buka</label>
                            <p class="ml-3">{{ $usaha->jam_buka }}</p>
                        </div>
                        <div class="col-6">
                            <label for="jam_tutup">Jam Tutup</label>
                            <p class="ml-3">{{ $usaha->jam_tutup }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="barang_jasa">Barang/Jasa tersedia</label>
                            <p class="ml-3">{{ $usaha->barang_jasa }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="alamat">Alamat Usaha</label>
                            <p class="ml-3">{{ $usaha->alamat }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="ket">Keterangan Tambahan</label>
                            <p class="ml-3">{{ $usaha->ket }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="foto">Dokumentasi:</label>
                            <div class="text-center">
                                <img src="{{ url($usaha->foto) }}" alt="" height="120">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <label for="latitude">Latitude</label>
                            <p class="ml-3">{{ $latlng[1] }}</p>
                        </div>
                        <div class="col-6">
                            <label for="longitude">Longitude</label>
                            <p class="ml-3">{{ $latlng[0] }}</p>
                        </div>
                    </div>
                    <div id="map" style="height: 250px;" class="mb-4"></div>
                    <div class="row justify-content-center mt-4">
                        <div class="col-12">
                            <a href="{{ url('/usaha') }}" class="btn btn-warning float-left"><i class="fas fa-arrow-left"></i> Kembali</a>
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
</script>
@endsection