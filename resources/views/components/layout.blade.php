<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{ asset('storage/img/warungota.png') }}" type="image/x-icon">

    <title>{{ env('APP_NAME') }}</title>

    {{-- alpine --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen bg-gray-50">
    {{-- header --}}
    <header class="h-16 bg-white sticky top-0 z-50 border-b">
        <div class="container flex items-center justify-between h-full">
            <x-logo></x-logo>
            @auth
                <a href="{{ route('dashboard') }}" class="btn">Dashboard</a>
            @endauth
            {{-- desktop nav --}}
            {{-- <div class="hidden lg:flex">
                <nav class="flex">
                    <x-lang />
                </nav>
            </div> --}}

            {{-- mobile nav --}}
            {{-- <div x-data="{ showMobileNav: false }" class="flex lg:hidden">
                <button x-on:click="showMobileNav = !showMobileNav" type="button">
                    <x-fas-bars class="size-7" />
                </button>
                <div x-on:click="showMobileNav = false"
                    :class="showMobileNav ? 'opacity-100 visible' : 'opacity-0 invisible'"
                    class="fixed left-0 top-0 w-full h-full z-50 bg-white/80 transition-all duration-500">
                    <nav :class="showMobileNav ? 'translate-x-0' : '-translate-x-full'"
                        class="border-r h-full w-[80%] bg-white transition-all duration-300">
                        <div class="p-4">
                            <div class="flex justify-between items-center">
                                <x-logo></x-logo>
                                <x-lang />
                            </div>
                        </div>
                    </nav>
                </div>
            </div> --}}
        </div>
    </header>

    {{-- main --}}
    <main x-data="{ showFilter: false, showShort: false }" class="grow">
        {{ $slot }}

        {{-- scroll to top and whatsapp --}}
        @if (!request()->is('login') && !request()->is('logout'))
            <div x-data="{ visible: false, timeout: null }" x-init="window.addEventListener('scroll', () => {
                visible = true;
                clearTimeout(timeout);
                timeout = setTimeout(() => visible = false, 2000);
            })" :class="visible ? 'translate-x-0' : 'translate-x-full'"
                class="fixed bottom-0 right-0 pr-4 pb-6 flex lg:hidden transition-transform duration-300 z-50"
                @mouseenter="clearTimeout(timeout)" @mouseleave="timeout = setTimeout(() => visible = false, 2000)">
                <div class="">
                    <a href="#top" class="mb-2 inline-block">
                        <x-bi-chevron-up class="size-10 text-blue-500" />
                    </a>
                    <a href="http://wa.me/6283192375769" class="hover:scale-105 transition">
                        <x-bi-whatsapp class="size-10 text-green-500" />
                    </a>
                </div>
            </div>
        @endif
    </main>


    {{-- footer --}}
    @if (!request()->is('login') && !request()->is('logout'))
        <footer class="py-6 border-t mt-4 bg-white mb-12">
            <div class="container h-full flex items-center gap-4">
                <x-logo />
                <div class="max-w-xs text-sm">
                    <p class="text-gray-600 mb-2">Bangong, Desa Pasirpogor, Kec. Sindangkerta, Kab. Bandung
                        Barat
                    </p>
                    <a href="http://wa.me/6283192375769" class="text-sm flex gap-2 items-center">
                        <x-bi-whatsapp class="size-4" />
                        083192375769
                    </a>
                </div>
            </div>
        </footer>
    @endif
</body>

</html>
