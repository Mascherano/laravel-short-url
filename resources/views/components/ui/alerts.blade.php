@if(session()->has('success'))
    <div x-data="{open: true}" x-init="setTimeout(() => {open = false }, 20000)" x-show="open" class="flex items-center p-2 mb-4 text-white bg-green-400 rounded">

        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 pt-1 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>
            {{ session('success') }}
        </span>

    </div>
@endif

@if(session()->has('error'))
    <div x-data="{open: true}" x-init="setTimeout(() => {open = false }, 5000)" x-show="open" class="flex items-center p-2 mb-4 text-white bg-red-600 rounded">

        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 pt-1 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>
            {{ session('error') }}
        </span>
        
    </div>
@endif

@if ($errors->all())
    @foreach ($errors->all() as $message)
        <div x-data="{open: true}" x-init="setTimeout(() => {open = false }, 5000)" x-show="open" class="flex items-center p-2 mb-4 text-white bg-red-600 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 pt-1 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>
                {{ $message }}
            </span>
        </div>
    @endforeach
@endif