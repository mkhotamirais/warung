<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{ asset('storage/img/logo-warungota-favicon.png') }}" type="image/x-icon">

    <title>{{ env('APP_NAME') }}</title>
    <meta name="description"
        content="{{ config('common.meta.description') ?? 'Warung ota adalah warung milik bu yanti di bangong depan MA Nurul Iman' }}">

    {{-- alpine --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen">
    <header class="h-16 bg-white sticky top-0 z-50 border-b">
        <div class="container flex items-center justify-between h-full">
            <x-logo />

            {{-- desktop nav --}}
            <div class="hidden lg:flex gap-6 items-center">
                <nav>
                    @foreach (__('common.menu') as $menu)
                        <a href="{{ $menu['url'] }}"
                            class="mx-3 text-gray-500 hover:text-black">{{ $menu['label'] }}</a>
                    @endforeach
                </nav>
                <a href="{{ config('common.links.wa') }}" class="btn">{{ __('common.common.btn-contact') }}</a>
                {{-- lang --}}
                <div class="font-semibold">
                    @if (session('locale') == 'en')
                        <a href="{{ route('set-locale', 'id') }}">EN</a>
                    @else
                        <a href="{{ route('set-locale', 'en') }}">ID</a>
                    @endif
                </div>
                <x-auth-btn />
            </div>

            {{-- mobile nav --}}
            <div x-cloak x-data="{ show: false }" class="flex lg:hidden">
                <button x-on:click="show = !show" type="button">
                    <x-fas-bars class="size-7" />
                </button>
                <div x-on:click="show = false" :class="show ? 'opacity-100 visible' : 'opacity-0 invisible'"
                    class="fixed left-0 top-0 w-full h-full z-50 bg-black/50 transition-all duration-500">
                    <div :class="show ? 'translate-x-0' : '-translate-x-full'"
                        class="border-r h-full w-[80%] bg-white transition-all duration-300">
                        <nav class="p-4">
                            <div class="flex justify-between items-center">
                                <x-logo />
                                {{-- lang --}}
                                <div class="font-semibold py-4">
                                    @if (session('locale') == 'en')
                                        <a href="{{ route('set-locale', 'id') }}">EN</a>
                                    @else
                                        <a href="{{ route('set-locale', 'en') }}">ID</a>
                                    @endif
                                </div>
                            </div>
                            <div class="py-4 space-y-2">
                                <a href="{{ config('common.links.wa') }}"
                                    class="btn">{{ __('common.common.btn-contact') }}</a>
                                <x-auth-btn />
                            </div>
                            <div>
                                @foreach (__('common.menu') as $menu)
                                    <a href="{{ $menu['url'] }}"
                                        class="block py-2 text-gray-500 hover:text-black">{{ $menu['label'] }}</a>
                                @endforeach
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- main --}}
    <main class="grow">{{ $slot }}</main>

    {{-- scroll to top and whatsapp --}}
    <div x-data="{ showScroll: false }" x-init="window.addEventListener('scroll', () => {
        showScroll = window.scrollY > 50;
    });"
        class="!z-50 fixed right-8 lg:right-16 bottom-8 flex flex-col items-center">
        {{-- Tombol Scroll to Top --}}
        <a href="#top" x-show="showScroll" x-transition
            class="mb-2 inline-block p-2 rounded-full mx-auto bg-blue-500/50">
            <x-bi-chevron-up class="size-4 text-blue-500" />
        </a>
        <a href="http://wa.me/6283192375769" class="hover:scale-105 transition">
            <x-bi-whatsapp class="size-12 text-green-500" />
        </a>
    </div>

    {{-- footer --}}
    <footer class="py-6 border-t mt-4 bg-white">
        <div class="container h-full flex flex-col lg:flex-row gap-4">
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
</body>

</html>
