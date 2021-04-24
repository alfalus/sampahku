<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Transaksi
    </h2>
</x-slot>
<div class="pt-12" >
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" id="step1"  style="display: ;">
        <div class="font-bold text-lg mb-6">
            Step 1 : Tambah Barang   
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <div id="permission-alert" class="hidden bg-red-400 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex">
                  <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                  <div>
                    <p class="font-bold">Alert!</p>
                    <p class="text-sm">Untuk dapat melanjutkan, anda harus mengaktifkan permission lokasi terlebih dahulu.</p>
                  </div>
                </div>
            </div>
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Barang</button>
            
            {{-- content modal --}}
            @if($isOpen)
                @include('livewire.order-modal')
            @endif
            
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-30">No</th>
                        <th class="px-4 py-2">Tipe Item</th>
                        <th class="px-4 py-2">Deskripsi</th>
                        <th class="px-4 py-2">Berat</th>
                        <th class="px-4 py-2">Gambar</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach($orders as $order)
                    <tr>
                        <td class="border px-4 py-2 text-center">{{ $no }}</td>
                        <td class="border px-4 py-2 text-center">{{ $order->type_item }}</td>
                        <td class="border px-4 py-2">{{ $order->description_item }}</td>
                        <td class="border px-4 py-2 text-center">{{ $order->estimate_weight }} KG</td>
                        <td class="border px-4 py-2">
                            <img src="{{asset("storage/photos/$order->capture_image")}}" style="max-height:200px;" alt=""></td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $order->id_detail }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                            <button wire:click="delete({{ $order->id_detail }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </td>
                    </tr>
                    @php
                        $no++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pt-3 pb-3">
            <div class="max-w-7xl mx-auto --sm:px-6 --lg:px-8 flex justify-end">
                 <div class="inline-block mt-2">
                    <button id="btn-step1" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded">Lanjut</button>
                 </div>
            </div>
        </div>
    </div>

    {{-- step 3 --}}
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" id="step2" style="display: none; ">
        <div class="font-bold text-lg mb-6">
            Step 2 : Konfirmasi   
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <div class="mb-5">
                <div class="font-bold text-lg mb-2">
                    Detail Penjemputan
                    <hr>
                </div>
                <div class="grid grid-cols-2 h-64 " >
                    <div>
                        <table class="md:w-full sm:w-full">
                            <tr>
                                <td class="w-32">Nama</td>
                                <td class="">:</td>
                                <td>dummy</td>
                            </tr>
                            <tr>
                                <td class="w-32">No HP</td>
                                <td class="">:</td>
                                <td>0812828</td>
                            </tr>
                            <tr>
                                <td class="w-32">Alamat</td>
                                <td class="">:</td>
                                <td>jl semana</td>
                            </tr>
                        </table>
                    </div>
                    <div class="bg-gray-400 " id="googleMap" style="width:100%; height:100%;">
                        maps
                    </div>

                </div>
            </div>
            <div class="mb-5">
                <div class="font-bold text-lg mb-2">
                    Detail Barang  
                    <hr>
                </div>
                <div class="flex border-b py-2 items-start mx-10 mt-5">
                    <div class="flex-1 px-1">
                        <p class="text-gray-800 uppercase tracking-wide text-sm font-bold">Keterangan</p>
                    </div>
    
                    <div class="flex-1 px-1 text-center">
                        <p class="text-gray-800 uppercase tracking-wide text-sm font-bold">Jenis</p>
                    </div>
        
                    <div class="px-1 w-20 text-center">
                        <p class="text-gray-800 uppercase tracking-wide text-sm font-bold">Berat</p>
                        <span class="font-medium text-xs text-gray-500">(KG)</span>
                    </div>
        
                    <div class="px-1 w-32 text-right">
                        <p class="leading-none">
                            <span class="block uppercase tracking-wide text-sm font-bold text-gray-800">Harga</span>
                            <span class="font-medium text-xs text-gray-500">(Per KG)</span>
                        </p>
                    </div>
        
                    <div class="px-1 w-48 text-right">
                        <p class="leading-none">
                            <span class="block uppercase tracking-wide text-sm font-bold text-gray-800">Total</span>
                            {{-- <span class="font-medium text-xs text-gray-500">(Incl. GST)</span> --}}
                        </p>
                    </div>
                </div>
                {{-- data --}}
                @php
                    $total=0;
                @endphp
                @foreach ($orders as $order)
                <div class="flex py-2 border-b mx-10 mb-5">
                    <div class="flex-1 px-1">
                        <p class="text-gray-800" x-text="invoice.name">{{$order->description_item}}</p>
                    </div>
    
                    <div class="flex-1 px-1 text-center">
                        <p class="text-gray-800" x-text="invoice.qty">{{$order->type_item}}</p>
                    </div>
    
                    <div class="px-1 w-20 text-center">
                        <p class="text-gray-800" x-text="invoice.qty">{{$order->estimate_weight}}</p>
                    </div>

                    <div class="px-1 w-32 text-right">
                        <p class="text-gray-800" x-text="numberFormat(invoice.rate)">Rp {{intVal($order->price_weight)}}</p>
                    </div>
    
                    <div class="px-1 w-48 text-right">
                        <p class="text-gray-800" x-text="numberFormat(invoice.total)">Rp {{$order->estimate_weight * intVal($order->price_weight)}}</p>
                    </div>
    
                </div>
                @php
                    $total += $order->estimate_weight * intVal($order->price_weight);
                @endphp
                @endforeach
                <div class="py-2 ml-auto mr-10 mt-5 w-full sm:w-2/4 lg:w-1/4">
                    <div class="flex justify-between mb-3">
                        <div class="text-gray-800 text-right flex-1">SubTotal</div>
                        <div class="text-right w-40">
                            <div class="text-gray-800 font-medium" id="subTotal">Rp {{$total}}</div>
                        </div>
                    </div>
                    <div class="flex justify-between mb-4">
                        <div class="text-sm text-gray-600 text-right flex-1">Diskon</div>
                        <div class="text-right w-40">
                            <div class="text-sm text-gray-600" id="diskon">Rp 0</div>
                        </div>
                    </div>
                
                    <div class="py-2 border-t border-b">
                        <div class="flex justify-between">
                            <div class="text-xl text-gray-600 text-right flex-1">Total Akhir</div>
                            <div class="text-right w-40">
                                <div class="text-xl text-gray-800 font-bold" id="grandTotal">Rp {{$total}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <div class="font-bold text-lg mb-2">
                    Pembayaran 
                    <hr>
                </div>
            </div>
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-orange-700 p-4" role="alert">
                <p class="font-bold">Perhatian</p>
                <p>Pembayaran dilakukan pada saat petugas datang ke lokasi.</p>
            </div>
            {{-- 3 --}}
        </div>
        <div class="pt-3 pb-3">
            <div class="max-w-7xl mx-auto --sm:px-6 --lg:px-8 flex justify-end">
                <form wire:submit.prevent="requestOrder" method="post">
                    <input type="hidden" id="lat">
                    <input type="hidden" id="long">


                    <div class="inline-block mr-2 mt-2">
                        <button id="btn-back2" type="button" class="disabled:opacity-50 focus:outline-none text-gray-600 text-sm py-2.5 px-5 rounded-md border border-gray-600 hover:bg-gray-50">Kembali</button>
                    </div>
                    <div class="inline-block mt-2">
                        <button id="btn-step2" wire:click.prevent="requestOrder()" class="bg-green-600 hover:bg-green-500 focus:border-green-700 focus:ring-2 focus:outline-none focus:shadow-outline-green text-white font-bold py-2.5 px-5 rounded inline-flex">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" style="display: none;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Pesan Sekarang
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<div class="px-12 pb-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="font-bold text-lg my-6">
            Histori Pemesanan   
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            
            {{-- content modal --}}
            @if($isOpen)
                @include('livewire.order-modal')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-30">No</th>
                        <th class="px-4 py-2">Bank Sampah</th>
                        <th class="px-4 py-2">Tanggal Angkut</th>
                        <th class="px-4 py-2">Deskripsi</th>
                        <th class="px-4 py-2">Kendaraan</th>
                        {{-- <th class="px-4 py-2">Gambar</th> --}}
                        <th class="px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    {{-- @foreach($history as $h)
                    <tr>
                        <td class="border px-4 py-2 text-center">{{ $no }}</td>
                        <td class="border px-4 py-2 text-center">{{ $h->id_bank_sampah  }}</td>
                        <td class="border px-4 py-2 text-center">{{ $h->date_order }}</td>
                        <td class="border px-4 py-2">{{ $h->description }}</td>
                        <td class="border px-4 py-2 text-center">{{ $h->vehicle }}</td>
                        <td class="border px-4 py-2">
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">{{ $h->status }}</button>
                        </td>
                    </tr>
                    @php
                        $no++;
                    @endphp
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('jquery')
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAowUzI5gEJwMIhyR7gGEPbM4hMlRunsZ0&callback=initMap&libraries=&v=weekly" async defer></script>
<script>
    checkBrowserSupport();
        function checkBrowserSupport() {
            if (navigator.geolocation) {
                handlePermission();
            }
            else {
                console.log('Geolocation is not supported for this Browser/OS.');
            }
        }

        function handlePermission() {
            var geoBtn = $("#permission-alert");
            navigator.permissions.query({name:'geolocation'}).then(function(result) {
            
            if (result.state == 'granted') {
                report(result.state);
                geoBtn.hide();
                navigator.geolocation.getCurrentPosition(success,error,options);

                // geoBtn.style.display = 'none';
            } else if (result.state == 'prompt') {
                report(result.state);
                // geoBtn.style.display = 'none';
                navigator.geolocation.getCurrentPosition(success,error,options);
            } else if (result.state == 'denied') {
                report(result.state);
                // geoBtn.style.display = 'inline';
                geoBtn.show();
            }
            result.onchange = function() {
                report(result.state);
                if (result.state == 'granted') {
                    report(result.state);
                    geoBtn.hide();
                navigator.geolocation.getCurrentPosition(success,error,options);

                    // geoBtn.style.display = 'none';
                } else if (result.state == 'prompt') {
                    report(result.state);
                    // geoBtn.style.display = 'none';
                    navigator.geolocation.getCurrentPosition(success,error,options);
                } else if (result.state == 'denied') {
                    report(result.state);
                    // geoBtn.style.display = 'inline';
                    geoBtn.show();
                }
            }
        });
        }

        function report(state) {
            console.log('Permission ' + state);
        }

        var options = {
            enableHighAccuracy: false,
            timeout: 5000,
            maximumAge: 5 * 60 * 1000
        };

        function success(pos) {
            var crd = pos.coords;

            console.log('Your current position is:');
            console.log(`Latitude : ${crd.latitude}`);
            console.log(`Longitude: ${crd.longitude}`);
            console.log(`More or less ${crd.accuracy} meters.`);
            global_lat = `${crd.latitude}`;
            global_long = `${crd.longitude}`;
            $("#lat").val(global_lat);
            $("#long").val(global_long);
            console.log(global_lat);
            console.log(global_long);

            window.livewire.emit('setLatLong', global_lat, global_long) 
        }

        function error(err) {
            console.warn(`ERROR(${err.code}): ${err.message}`);
        }
</script>
<script type="text/javascript">
    var global_lat;
    var global_long;
    function initMap() {
    const map = new google.maps.Map(document.getElementById("googleMap"), {
        zoom: 8,
        center: { lat: -6.1944821, lng: 106.8094739 },
    });
    const geocoder = new google.maps.Geocoder();
    const infowindow = new google.maps.InfoWindow();
    geocodeLatLng(geocoder, map, infowindow);
    // document.getElementById("submit").addEventListener("click", () => {
    // });
    }

    function geocodeLatLng(geocoder, map, infowindow) {
    // const input = document.getElementById("latlng").value;
    // const input = '-7.90605830808734,112.56970977109289';
    const input = $("#lat").val()+','+$("#long").val();
    const latlngStr = input.split(",", 2);
    const latlng = {
        lat: parseFloat(latlngStr[0]),
        lng: parseFloat(latlngStr[1]),
    };
    geocoder.geocode({ location: latlng }, (results, status) => {
        if (status === "OK") {
            if (results[0]) {
                map.setZoom(11);
                const marker = new google.maps.Marker({
                position: latlng,
                map: map,
                });
                infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, marker);
            } else {
                window.alert("Gagal memproses");
            }
        } else {
            window.alert("Gagal mengambil lokasi saat ini : " + status);
        }
    });
    }


    
    $(document).ready(function() {
        


        $("#btn-step1").on('click', function(){
            $("#step1").hide();
            $("#step2").show();
            
        })
        $("#btn-step2").on('click', function(){
            var btn = $('.animate-spin');
            btn.show();
        })

        $("#btn-back2").on('click', function(){
            $("#step2").hide();
            $("#step1").show();
        })

        // $("#btn-back3").on('click', function(){
        //     $("#step3").hide();
        //     $("#step2").show();
        // })

        $("#step2").on('change', function(){
            console.log('true');
        })
    })
</script>
    
@stop