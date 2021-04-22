<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Transaksi
    </h2>
</x-slot>
<div class="pt-12" id="step1">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                            <button wire:click="edit({{ $order->id_mgt_item }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                            <button wire:click="delete({{ $order->id_mgt_item }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </td>
                    </tr>
                    @php
                        $no++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="pt-3 pb-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-end">
            {{-- <div class="inline-block mr-2 mt-2">
                <button type="button" class="focus:outline-none text-gray-600 text-sm py-2.5 px-5 rounded-md border border-gray-600 hover:bg-gray-50">Kembali</button>
             </div> --}}
             <div class="inline-block mr-2 mt-2">
                {{-- <button type="button" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg">Success</button> --}}
                <button id="btn-step1" class="bg-green-600 hover:bg-green-500 focus:border-green-700 focus:outline-none focus:shadow-outline-green text-white font-bold py-2.5 px-5 rounded">Lanjut</button>
             </div>
        </div>
    </div>
</div>

<div class="pt-12" id="step2" style="display: none;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Barang</button>
            
            
            
        </div>
    </div>
    <div class="pt-3 pb-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-end">
            <div class="inline-block mr-2 mt-2">
                <button id="btn-back2" type="button" class="focus:outline-none text-gray-600 text-sm py-2.5 px-5 rounded-md border border-gray-600 hover:bg-gray-50">Kembali</button>
            </div>
            <div class="inline-block mr-2 mt-2">
                <button id="btn-step2" wire:click="next()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded">Lanjut</button>
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
            {{-- <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Barang</button> --}}
            
            {{-- content modal --}}
            @if($isOpen)
                @include('livewire.order-modal')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-30">No</th>
                        <th class="px-4 py-2">Tanggal Angkut</th>
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
                    {{-- @foreach($orders as $order) --}}
                    {{-- <tr>
                        <td class="border px-4 py-2 text-center">{{ $no }}</td>
                        <td class="border px-4 py-2 text-center">{{ $order->type_item }}</td>
                        <td class="border px-4 py-2">{{ $order->description_item }}</td>
                        <td class="border px-4 py-2 text-center">{{ $order->estimate_weight }} KG</td>
                        <td class="border px-4 py-2">
                            <img src="{{asset("storage/photos/$order->capture_image")}}" style="max-height:200px;" alt=""></td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $order->id_mgt_item }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                            <button wire:click="delete({{ $order->id_mgt_item }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </td>
                    </tr> --}}
                    {{-- @php
                        $no++;
                    @endphp --}}
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('jquery')
<script>
    $(document).ready(function() {
        $("#btn-step1").on('click', function(){
            $("#step1").toggle('slide');
            $("#step2").toggle('slide');
            // alert(true);
        })
        $("#btn-step2").on('click', function(){
            $("#step2").toggle('slide');
            $("#step1").toggle('slide');
            // alert(true);
        })

        $("#btn-back2").on('click', function(){
            $("#step2").toggle('slide');
            $("#step1").toggle('slide');
        })
    })
</script>
    
@stop