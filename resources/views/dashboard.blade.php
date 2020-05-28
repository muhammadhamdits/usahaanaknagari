@extends('layout.app')

@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=&v=weekly" defer></script>
<script>
    var map;
    function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 8
    });
    }
</script>
@endsection

@section('content')
<div class="row">
    <section class="col-12 connectedSortable">
        <div class="card">
            <div class="card-body">
                <div id="map" style="height: 425px;"></div>
            </div>
        </div>
    </section>
</div>
@endsection