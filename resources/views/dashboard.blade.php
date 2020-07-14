@extends('layout.app')

@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=&v=weekly" defer></script>
<script>
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -0.952290556786962, lng: 100.419888496399 },
            zoom: 16
        });
            
        infoWindow = new google.maps.InfoWindow();

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
</script>
@endsection

@section('content')
<div class="row" id="kanvas">
    <section class="col-12 connectedSortable" id="kiri">
        <div class="card">
            <div class="card-body">
                <div id="map" style="height: 425px;"></div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $.getJSON("{{ route('usaha.json') }}", function(json1) {
            var i = 0;
            $.each(json1, function(key, data) {
                let latLng = new google.maps.LatLng(data.lat, data.lng);
                // Creating a marker and putting it on the map
                let marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    title: data.title
                });
                
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        let contentString=
                        "<a href='/usaha/"+data.id+"' target='_blank'>"+data.title+"</a>";
                        infoWindow.setContent(contentString);
                        infoWindow.open(map, marker);
                    }
                })(marker, i));

                i++;
            });
        });

        $("#usaha").on('keyup', function(e){
            let nama = $(this).val();
            $("#kiri").attr('class', 'col-9 connectedSortable');

            var kanan =
            "<section class='col-3 connectedSortable' id='kanan'>"+
                "<div class='card'>"+
                    "<div class='card-body' id='isiKanan' style='height: 465px; overflow-y: scroll'>";
            $.getJSON("/json/nama/"+nama, function(data) {
                $.each(data, function(key, data) {
                    kanan += 
                    "<li>"+
                        "<a href='javascript:void(0);' onclick='mapAnimate("+data.lat+", "+data.lng+")'>"
                            +data.title+
                        "</a>"+
                    "</li>";
                });
                    kanan +=
                        "</div>"+
                    "</div>"+
                "</section>";

                if($("#kanvas").children().eq(1)){
                    $("#kanvas").children().eq(1).remove();
                }
                $("#kanvas").append(kanan);
            });
        });

        $("#regionRange").on('change', function(e){
            var radius = $(this).val();
            navigator.geolocation.getCurrentPosition(function(position){
                let lat = position.coords.latitude;
                let lng = position.coords.longitude;
                $("#kiri").attr('class', 'col-9 connectedSortable');

                var kanan =
                "<section class='col-3 connectedSortable' id='kanan'>"+
                    "<div class='card'>"+
                        "<div class='card-body' id='isiKanan' style='height: 465px; overflow-y: scroll'>";

                $.getJSON("/json/radius/"+radius+"/"+lat+"/"+lng, function(res){
                    $.each(res, function(key, value){
                        kanan += 
                        "<li>"+
                            "<a href='javascript:void(0);' onclick='mapAnimate("+value.lat+", "+value.lng+")'>"
                                +value.title+
                            "</a>"+
                        "</li>";
                    });
                        kanan +=
                            "</div>"+
                        "</div>"+
                    "</section>";

                    if($("#kanvas").children().eq(1)){
                        $("#kanvas").children().eq(1).remove();
                    }
                    $("#kanvas").append(kanan);
                });
            });
        });

        $("#businessType").on('change', function(e){
            let type = $(this).val();
            $("#kiri").attr('class', 'col-9 connectedSortable');

            var kanan =
            "<section class='col-3 connectedSortable' id='kanan'>"+
                "<div class='card'>"+
                    "<div class='card-body' id='isiKanan' style='height: 465px; overflow-y: scroll'>";
            $.getJSON("/json/type/"+type, function(data) {
                $.each(data, function(key, data) {
                    kanan += 
                    "<li>"+
                        "<a href='javascript:void(0);' onclick='mapAnimate("+data.lat+", "+data.lng+")'>"
                            +data.title+
                        "</a>"+
                    "</li>";
                });
                    kanan +=
                        "</div>"+
                    "</div>"+
                "</section>";

                if($("#kanvas").children().eq(1)){
                    $("#kanvas").children().eq(1).remove();
                }
                $("#kanvas").append(kanan);
            });
        });
    })

    function mapAnimate(lat, lng){
        let pos = {
            lat: lat,
            lng: lng
        };
        map.setCenter(pos);
    }

    window.onload = function() {
        if(!window.location.hash) {
            window.location = window.location + '#loaded';
            window.location.reload();
        }
    }
</script>
@endsection