<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />
        
        <form method="POST" action="{{ route('register') }}">
            <div class="flex">
                <div class="flex-1 w-full sm:max-w-md m-3 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg text-center">
                    <label class="cursor-pointer block">
                        <input type="radio" class="block form-checkbox h-5 w-5 text-green-600 mx-auto" id="role_user" name="role" value="1" checked>
                        <span class="ml-2 text-gray-700">Daftar sebagai User</span>
                    </label>
                </div>
                <div class="flex-1 w-full sm:max-w-md m-3 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg text-center">
                    <label class="cursor-pointer block">
                        <input type="radio" class="block form-checkbox h-5 w-5 text-green-600 mx-auto" id="role_pengepul" name="role" value="2">
                        <span class="ml-2 text-gray-700">Daftar sebagai Bank Sampah</span>           
                    </label>
                </div>
            </div>

            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Nama') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="off" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>
            
            <div class="mt-4">
                <x-jet-label for="no_hp" value="{{ __('No. HP') }}" />
                <x-jet-input id="no_hp" class="block mt-1 w-full" type="text" pattern="\d*" name="no_hp" :value="old('no_hp')" required maxlength="13"/>
            </div>

            <div class="mt-4">
                <x-jet-label for="alamat" value="{{ __('Alamat') }}" />
                <textarea class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full resize-y border rounded-md" :value="old('alamat')" id="alamat" name="alamat"></textarea>
            </div>
            
            <div class="mt-4">
                <x-jet-label for="address" value="{{ __('Kota/Kabupaten') }}" />
                <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full cursor-pointer form-select mt-1 block w-full" id="kota" name="kota" required>
                    <option value="">-- Pilih Kota/Kabupaten --</option>
                </select>
            </div>
            <div class="mt-4">
                <x-jet-label for="address" value="{{ __('Kecamatan') }}" />
                <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full cursor-pointer form-select mt-1 block w-full" id="kecamatan" name="kecamatan" required>
                    <option value="">-- Pilih Kecamatan --</option>
                </select>
            </div>
            <div class="mt-4">
                <x-jet-label for="address" value="{{ __('Kelurahan') }}" />
                <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full cursor-pointer form-select mt-1 block w-full" id="kelurahan" name="kelurahan" required>
                    <option value="">-- Pilih Kelurahan --</option>
                </select>
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function(){
    var area_lock = {{env('AREA_LOCK')}};

    $.get("{{env('API_GET_PROV')}}", function(data, status){
        $.each(data.provinsi,function(i,val){
            if (area_lock==true) {
                var allowed = "{{env('AREA_ALLOW')}}";
            }
            if (allowed.includes(val.id)) {
                var $option = $("<option/>", {
                    value: val.id,
                    text: val.nama.toUpperCase()
                });
                $("#provinsi").append($option);
            }
        })
    });


    // $("#provinsi").on('change',function(){
        // removeOption(["kota","kecamatan","kelurahan"]);
        var idprov = '{{env('AREA_ALLOW')}}';
        $.get("{{env('API_GET_KOTA')}}?id_provinsi="+idprov, function(data, status){
            $.each(data.kota_kabupaten,function(i,val){
                var $option = $("<option/>", {
                    value: val.id,
                    text: val.nama.toUpperCase()
                });
                $("#kota").append($option);
            })
        });
    // })

    $("#kota").on('change',function(){
        removeOption(["kecamatan","kelurahan"]);
        var idkota = $(this).val();
        $.get("{{env('API_GET_KEC')}}?id_kota="+idkota, function(data, status){
            $.each(data.kecamatan,function(i,val){
                var $option = $("<option/>", {
                    value: val.id,
                    text: val.nama.toUpperCase()
                });
                $("#kecamatan").append($option);
            })
        });
    })

    $("#kecamatan").on('change',function(){
        removeOption(["kelurahan"]);
        var idkecamatan = $(this).val();
        $.get("{{env('API_GET_KEL')}}?id_kecamatan="+idkecamatan, function(data, status){
            $.each(data.kelurahan,function(i,val){
                var $option = $("<option/>", {
                    value: val.id,
                    text: val.nama.toUpperCase()
                });
                $("#kelurahan").append($option);
            })
        });
    })

    function removeOption(id){
        $.each(id, function(i, val){
            $('#' +val+' option').each(function() {
                if ( $(this).val() != '' ) {
                    $(this).remove();
                }
            });
        })
    }
})
</script>

