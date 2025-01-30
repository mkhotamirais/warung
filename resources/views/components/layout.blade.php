<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ env('APP_NAME') }}</title>

    {{-- alpine --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen">
    {{-- header --}}
    <header class="h-16 bg-white sticky top-0 z-50 border-b">
        <div class="container flex items-center justify-between h-full">
            <x-logo></x-logo>

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
    <main class="grow container">
        {{ $slot }}
    </main>

    {{-- footer --}}
    <footer class="h-16 border-t mt-4">
        <div class="container flex flex-col items-center justify-center h-full">
            <p>@warungota2025</p>
            <div class="flex gap-2 opacity-0">
                <a href="{{ route('login') }}">login</a>
                <a href="{{ route('register') }}">register</a>
            </div>
        </div>
    </footer>
</body>

</html>
