<x-app-layout>
    <div class="w-full h-64 bg-no-repeat bg-cover bg-center" style="background-image: url({{env('IMG_BANNER')}})">
        <div class="flex items-center justify-center h-full w-full bg-gray-900 bg-opacity-50">
            <div class="text-center">
                <h1 class="text-white text-2xl font-semibold uppercase md:text-3xl">Berita</h1>
            </div>
        </div>
    </div>

    <div class="pb-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-12">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> --}}
                
                <div class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-12">
                    @foreach ($resp['articles'] as $data)
                        @if ($data['author'] != 'Kapanlagicom' && stripos($data['content'], env('NEWS_QUERY') ) )
                        <div class="group rounded overflow-hidden shadow-lg bg-white">
                            <img class="group-hover:cursor-pointer w-full" src="{{$data['urlToImage']}}" alt="img-">
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">
                                    <a class="hover:underline" href="{{$data['url']}}" target="_blank">{{$data['title']}}</a>
                                </div>
                                <p class="text-gray-700 text-base text-justify">
                                {{explode('[',$data['content'])[0]}}
                                <a class="underline italic text-blue-700" href="{{$data['url']}}" target="_blank">(Baca Selengkapnya)</a>
                                </p>
                            </div>
                            {{-- <div class="px-6 pt-4 pb-2 relative">
                                <div class="absolute inset-x-0 bottom-0 ">
                                    <div class="text-sm">
                                      <p class="text-black leading-none">{{ $data['author'] }}</p>
                                      <p class="text-grey-dark">{{ $data['publishedAt'] }}</p>
                                    </div>

                                </div>
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
                            </div> --}}
                        </div>
                            
                        @endif    
                    @endforeach
                </div>
            {{-- </div> --}}
        </div>
    </div>

</x-app-layout>
