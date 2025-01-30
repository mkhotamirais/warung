@props(['cats' => [], 'route' => 'category-blogs', 'current' => null])

<form method="GET" action="{{ url()->current() }}" class="flex gap-1 overflow-x-scroll">
    @if (request('search'))
        <input type="hidden" name="search" value="{{ request('search') }}">
    @endif

    @if (request('sort'))
        <input type="hidden" name="sort" value="{{ request('sort') }}">
    @endif

    {{-- @if (request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
    @endif --}}

    <label class="badge-filter {{ request('category') == '' ? '!bg-blue-500 !text-white' : '' }}">
        <input type="radio" name="category" value="" {{ request('category') == '' ? 'checked' : '' }}
            onchange="this.form.submit()" class="hidden">
        <span>Semua Kategori</span>
    </label>

    @foreach ($cats as $cat)
        <label class="badge-filter {{ request('category') == $cat->slug ? '!bg-blue-500 !text-white' : '' }}">
            <input type="radio" name="category" value="{{ $cat->slug }}"
                {{ request('category') == $cat->slug ? 'checked' : '' }} onchange="this.form.submit()" class="hidden">
            <span>{{ $cat->name }}</span>
        </label>
    @endforeach

    {{-- Blur effect on the right --}}
    <div
        class="block lg:hidden absolute top-0 right-0 h-full w-8 bg-gradient-to-l from-white via-white/40 to-transparent pointer-events-none">
    </div>
</form>
