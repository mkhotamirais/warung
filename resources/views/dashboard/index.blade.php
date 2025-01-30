<x-authlayout>
    <h1 class="title">Halo, {{ auth()->user()->name ?? '' }} your are {{ auth()->user()->role }}</h1>
    <div class="flex flex-col gap-2">
        @foreach (config('common.menu') as $menu)
            <a href="{{ route($menu['route']) }}" class="btn w-fit">{{ $menu['name'] }}</a>
        @endforeach
    </div>
</x-authlayout>
