<x-layout>
    <form class="w-auto lg:w-80 sticky top-16 py-2 bg-white z-50">

        {{-- @if (request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif --}}

        @if (request('sort'))
            <input type="hidden" name="sort" value="{{ request('sort') }}">
        @endif

        @if (request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif

        <div class="items-center flex sm:space-y-0">
            <div class="relative w-full">
                <label for="search"
                    class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cari</label>
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <x-bi-search class="w-5 h-5 text-gray-500 dark:text-gray-400"></x-bi-search>
                </div>
                <input type="search" name="search" autocomplete="off" value="{{ $search }}"
                    class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-l-lg focus:ring-primary-500 focus:border-primary-500"
                    placeholder="Cari dari {{ $total }} produk" type="text" id="search">
            </div>
            <div>
                <button type="submit"
                    class="rounded-l-none py-3 px-5 text-sm font-medium text-center text-white border cursor-pointer bg-blue-500 transition hover:bg-blue-600  rounded-r-lg focus:ring-4 focus:ring-blue-300">
                    Cari
                </button>
            </div>
        </div>
    </form>

    <div class="mb-2">
        <x-badge-sorting :sorting="config('common.sorting-price')" />
    </div>

    <div class="relative mb-4">
        <x-badge-cat :cats="$productcats" />
    </div>


    <div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-1 lg:gap-2">
            @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
        <div class="py-4">
            {{ $products->links() }}
        </div>
    </div>
</x-layout>
