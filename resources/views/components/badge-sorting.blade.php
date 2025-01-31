@props(['sorting' => [], 'name' => 'sort'])

<form method="GET" action="{{ url()->current() }}" class="flex gap-1 flex-wrap">
    @if (request('search'))
        <input type="hidden" name="search" value="{{ request('search') }}">
    @endif

    @if (request('sort') && $name !== 'sort')
        <input type="hidden" name="sort" value="{{ request('sort') }}">
    @endif

    @if (request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
    @endif

    @if (request('filter_image') && $name !== 'filter_image')
        <input type="hidden" name="filter_image" value="{{ request('category') }}">
    @endif

    @foreach ($sorting as $key => $sort)
        <label class="badge-filter {{ request($name) == $key ? '!bg-blue-500 !text-white' : '' }}">
            <input type="radio" name="{{ $name }}" value="{{ $key }}"
                {{ request($name) == $key ? 'checked' : '' }} onchange="this.form.submit()" class="hidden">
            <span>{{ $sort }}</span>
        </label>
    @endforeach
</form>
