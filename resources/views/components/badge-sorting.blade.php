@props(['sorting' => []])

<form method="GET" action="{{ url()->current() }}" class="flex gap-1 overflow-x-scroll">
    @if (request('search'))
        <input type="hidden" name="search" value="{{ request('search') }}">
    @endif

    {{-- @if (request('sort'))
        <input type="hidden" name="sort" value="{{ request('sort') }}">
    @endif --}}

    @if (request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
    @endif
    @foreach ($sorting as $key => $sort)
        <label class="badge-filter {{ request('sort') == $key ? '!bg-blue-500 !text-white' : '' }}">
            <input type="radio" name="sort" value="{{ $key }}"
                {{ request('sort') == $key ? 'checked' : '' }} onchange="this.form.submit()" class="hidden">
            <span>{{ $sort }}</span>
        </label>
    @endforeach
</form>
