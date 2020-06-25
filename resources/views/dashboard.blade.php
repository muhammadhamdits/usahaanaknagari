@extends('layout.app')

@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=&v=weekly" defer></script>
<script>
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 16
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent('Lokasi sekarang');
                infoWindow.open(map);
                map.setCenter(pos);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }

    $.getJSON("{{ route('usaha.json') }}", function(json1) {
        $.each(json1, function(key, data) {
            var latLng = new google.maps.LatLng(data.lat, data.lng); 
            // Creating a marker and putting it on the map
            var marker = new google.maps.Marker({
                position: latLng,
                map: map,
                title: data.title
            });
        });
    });
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