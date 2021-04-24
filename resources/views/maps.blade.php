@extends('layouts.maps')
<x-app-layout>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lihat Lokasi
            </h2>
        </div>
    </header>

    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <div id="googleMap" style="width:100%;height:380px;"></div>

            </div>
        </div>    

                

    </div>

</x-app-layout>

@section('script')
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
    function initialize() {
    var propertiPeta = {
        center:new google.maps.LatLng(-6.1547106,106.8053014),
        zoom:9,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    
    var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
    
    // membuat Marker
    var marker=new google.maps.Marker({
        position: new google.maps.LatLng(-6.1547106,106.8053014),
        map: peta
    });

    }

    // event jendela di-load  
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

    
@endsection
