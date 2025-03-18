<x-authlayout>
    <h1 class="title my-6">Halo, {{ auth()->user()->name ?? '' }} your are {{ auth()->user()->role }}</h1>
    @if (auth()->user()->role === 'user')
        <a href="{{ route('product') }}" class="btn w-fit">Products</a>
    @else
        <div class="flex flex-col gap-2">
            @foreach (config('common.menu') as $menu)
                @if (auth()->user()->role === 'editor' && $menu['route'] === 'users')
                    @continue
                @endif
                <a href="{{ route($menu['route']) }}" class="btn w-fit">{{ $menu['name'] }}</a>
            @endforeach
        </div>
    @endif
</x-authlayout>
