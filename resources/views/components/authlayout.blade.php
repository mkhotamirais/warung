<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ env('APP_NAME') }}</title>

    {{-- alpine --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    {{-- vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen">
    {{-- header --}}
    <header class="h-16 bg-white sticky top-0 z-50 border-b">
        <div class="container flex items-center justify-between h-full">
            <x-logo></x-logo>
            {{-- logout btn --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" href="" class="btn">Logout</button>
            </form>
        </div>
    </header>

    <nav class="container sticky top-16 bg-white z-50">
        <div class="py-2 flex gap-2 overflow-x-scroll">
            @foreach (config('common.menu') as $menu)
                <a href="{{ route($menu['route']) }}"
                    class="{{ request()->routeIs($menu['route']) ? '!bg-blue-600' : '' }} btn">{{ $menu['name'] }}</a>
            @endforeach
        </div>
    </nav>

    {{-- main --}}
    <main class="grow py-2 container">
        {{ $slot }}
    </main>

    {{-- footer --}}
    <footer class="h-16 border-t">
        <div class="container flex items-center justify-center h-full">
            <p>warungota 2025</p>
        </div>
    </footer>
</body>

</html>
