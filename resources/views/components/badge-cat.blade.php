@props(['cats' => [], 'total' => 0, 'totalCats' => 0])

<form method="GET" action="{{ url()->current() }}" class="flex gap-1 flex-wrap">
    @if (request('search'))
        <input type="hidden" name="search" value="{{ request('search') }}">
    @endif

    @if (request('sort'))
        <input type="hidden" name="sort" value="{{ request('sort') }}">
    @endif

    {{-- @if (request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
    @endif --}}

    @if (request('filter_image'))
        <input type="hidden" name="filter_image" value="{{ request('filter_image') }}">
    @endif

    <label class="badge-filter {{ request('category') == '' ? '!bg-blue-500 !text-white' : '' }}">
        <input type="radio" name="category" value="" {{ request('category') == '' ? 'checked' : '' }}
            onchange="this.form.submit()" class="hidden">
        <span>Semua {{ $totalCats }} Kategori ({{ $total }})</span>
    </label>

    @foreach ($cats as $cat)
        <label class="badge-filter {{ request('category') == $cat->slug ? '!bg-blue-500 !text-white' : '' }}">
            <input type="radio" name="category" value="{{ $cat->slug }}"
                {{ request('category') == $cat->slug ? 'checked' : '' }} onchange="this.form.submit()" class="hidden">
            <span>{{ $cat->name }} ({{ $cat->products_count }})</span>
        </label>
    @endforeach

    {{-- Blur effect on the right --}}
    {{-- <div
        class="block lg:hidden absolute top-0 right-0 h-full w-8 bg-gradient-to-l from-white via-white/40 to-transparent pointer-events-none">
    </div> --}}
</form>
