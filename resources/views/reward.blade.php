<x-app-layout>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Reward
            </h2>
        </div>
    </header>
    <div class="pt-12">
        <div class="rounded-t-xl overflow-hidden pb-5 px-10">
            <div class="grid grid-rows-2 grid-cols-3 grid-flow-col gap-4">
                <div class="row-span-1 col-span-1 bg-white rounded-md p-5 text-center --items-center text-gray-800 font-semibold text-xl">
                    <div class="block px-3 pb-3">Jumlah Transaksi</div>
                    <hr>
                    <div class="block p-10">
                        <div class="text-4xl">{{__($trx)}} Transaksi</div>
                    </div>
                    <div class="text-sm text-gray-400">
                        *) Reward dapat ditukarkan setiap melakukan 5 transaksi
                    </div>
                    @if ($trx<=5)
                    <div class="block">
                        <button disabled class="disabled:opacity-50 cursor-not-allowed bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3" title="Klaim Reward">Klaim Reward</button>
                    </div>
                    @else
                    <div class="block">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3" title="Klaim Reward">Klaim Reward</button>
                    </div>
                        
                    @endif
                </div>
                <div class="col-span-2 row-span-2 bg-white rounded-md p-5 text-center --items-center text-gray-800 font-semibold text-xl">
                    <div class="block px-3 pb-3">Riwayat Klaim Reward</div>
                    <hr>
                    {{-- <div class="bg-gray-100 p-3 my-3">used    |   2021-04-09 22:07:30</div>
                    <div class="bg-gray-100 p-3 my-3">unused    |   2021-04-10 23:09:40</div>
                    <div class="bg-gray-100 p-3 my-3">unused    |   2021-04-11 21:05:10</div>
                     --}}
                </div>
            </div>
        </div>    

                

    </div>

</x-app-layout>
