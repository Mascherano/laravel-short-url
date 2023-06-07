<div>

    <div class="flex w-full p-3 space-x-2">

        {{-- Search Box --}}
        <div class="w-3/6">
            <span class="absolute z-10 items-center justify-center w-8 h-full py-3 pl-3 text-base font-normal leading-snug text-center text-gray-400 bg-transparent rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
            <input wire:model.debounce.300ms='search' type="text" class="relative w-full px-3 py-3 pl-10 text-sm text-gray-700 placeholder-gray-400 bg-gray-100 border-none rounded shadow-inner outline-none focus:outline-none focus:shadow-outline focus:ring-0 focus:bg-indigo-100" placeholder="Busca Urls">
        </div>

        {{-- Order By --}}
        <div class="relative w-1/6">
            <select wire:model='orderBy' id="" class="relative w-full px-3 py-3 pl-10 text-sm text-gray-700 placeholder-gray-400 bg-gray-100 border-none rounded shadow-inner outline-none focus:outline-none focus:shadow-outline focus:ring-0 focus:bg-indigo-100">
                <option value="id">ID</option>
                <option value="created_at">Creación</option>
            </select>
        </div>

        {{-- Order Asc --}}
        <div class="relative w-1/6">
            <select wire:model='orderAsc' id="" class="relative w-full px-3 py-3 pl-10 text-sm text-gray-700 placeholder-gray-400 bg-gray-100 border-none rounded shadow-inner outline-none focus:outline-none focus:shadow-outline focus:ring-0 focus:bg-indigo-100">
                <option value="asc">Ascendente</option>
                <option value="desc">Descendente</option>
            </select>
        </div>

        {{-- Per Page --}}
        <div class="relative w-1/6">
            <select wire:model='perPage' id="" class="relative w-full px-3 py-3 pl-10 text-sm text-gray-700 placeholder-gray-400 bg-gray-100 border-none rounded shadow-inner outline-none focus:outline-none focus:shadow-outline focus:ring-0 focus:bg-indigo-100">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>

    </div>

    {{-- Table --}}
    <table class="w-full divide-y divide-gray-200">

        <thead class="font-bold text-gray-500 bg-indigo-200">
            <tr>
                <th class="px-2 py-3 text-xs tracking-wider text-left uppercase">
                </th>
                <th class="px-2 py-3 text-xs tracking-wider text-left uppercase">
                    Id
                </th>
                <th class="px-2 py-3 text-xs tracking-wider text-left uppercase">
                    Url
                </th>
                <th class="px-2 py-3 text-xs tracking-wider text-left uppercase">
                    Código Corto
                </th>
                <th class="px-2 py-3 text-xs tracking-wider text-left uppercase">
                    Creación
                </th>
                <th class="px-2 py-3 text-xs tracking-wider text-left uppercase">
                    Acciones
                </th>
            </tr>
        </thead>

        <tbody class="text-xs divide-y divide-gray-200 bg-indigo-50 text-left">
            @foreach ($shortUrls as $shorturl)
                
                <tr>
                    <td class="px-2 py-4 whitespace-nowrap">
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap">
                        {{ $shorturl->id }}
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap">
                        {{ Str::limit($shorturl->url, 100, '...') }}
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap">
                        <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="{{ route('shorturl.redirecttourl', $shorturl->shortcode)  }}" target="_blank">
                            {{ url('') . '/' .$shorturl->shortcode  }}
                        </a>
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap">
                        {{ $shorturl->created_at->format('d/m/y') }}
                    </td>
            
                    <td class="px-2 py-4 text-sm text-gray-500 whitespace-nowrap">

                        <div class="flex justify-start space-x-1">
                            <form method="POST" action="{{ route('shorturl.delete', $shorturl) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="p-1 border-2 border-red-200 rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>

                    </td>
                </tr>

            @endforeach
            
        </tbody>

    </table>

    <div class="p-2 bg-indigo-300">
        {{ $shortUrls->links() }}
    </div>
</div>
