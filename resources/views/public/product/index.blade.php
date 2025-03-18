<x-layout>
    {{-- search --}}
    <div x-data="{ showFilter: false, showShort: false }" class="sticky top-16 py-2 bg-gray-100 z-40">
        <div class="container flex justify-between items-center gap-2">
            {{-- search --}}
            <form class="w-auto lg:w-80">

                {{-- @if (request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif --}}

                @if (request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif

                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif

                <div class="items-center flex relative rounded-lg overflow-hidden border border-gray-100">
                    <input type="search" name="search" autocomplete="off" value="{{ $search }}"
                        class="focus:outline-none block p-3 pr-12 w-full text-sm text-gray-900 bg-white"
                        placeholder="Cari dari {{ $total }} produk" type="text" id="search">

                    <button type="submit" class="absolute right-0 w-12 h-full flex items-center justify-center">
                        <x-bi-search class="w-5 h-5 text-gray-500 dark:text-gray-400" />
                    </button>
                </div>
            </form>
            {{-- filter and sort --}}
            <div class="flex items-center justify-around gap-1">
                <button x-on:click="showFilter = !showFilter" type="button"
                    :class="showFilter ? 'bg-blue-500 text-white' : 'bg-white text-gray-600'"
                    class="flex gap-1 items-center justify-center border w-full rounded p-2 hover:bg-blue-500 hover:text-white">
                    <x-fas-filter class="size-4" />
                    <span class="hidden lg:block">Filter</span>
                </button>

                <button x-on:click="showShort = !showShort"
                    :class="showShort ? 'bg-blue-500 text-white' : 'bg-white text-gray-600'"
                    class="flex gap-1 items-center justify-center border w-full rounded p-2 hover:bg-blue-500 hover:text-white">
                    <x-fas-sort class="size-4" />
                    <span class="hidden lg:block">Sort</span>
                </button>
            </div>
            <div class="py-2 bg-gray-100 fixed bottom-0 h-auto left-0 right-0 z-50">

                <div class="container">

                    <div x-show="showFilter" class="bg-white mt-1 p-2 border rounded">
                        <h3 class="text-gray-600 mb-2">Filter</h3>
                        <h4 class="text-sm pb-1">Category</h4>
                        <x-badge-cat :totalCats="$totalCats" :total="$total" :cats="$productcats" />
                        <h4 class="text-sm pb-1">Image</h4>
                        <x-badge-sorting name="filter_image" :sorting="config('common.filter-image')" />
                    </div>
                    <div x-show="showShort" class="bg-white mt-1 p-2 border rounded">
                        <span class="text-sm text-gray-600 mb-2 inline-block">Sort</span>
                        <x-badge-sorting name="sort" :sorting="config('common.sorting')" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- result --}}
    <div class="container mt-2">
        @if ($search || $sort || $category_slug)
            <div class="mb-4">
                <p class="">
                    @if ($search)
                        Hasil pencarian <span class="font-semibold">"{{ $search }}"</span>
                    @endif
                    @if ($sort)
                        Sorting <span class="font-semibold">"{{ $sort }}"</span>
                    @endif
                    @if ($category_slug)
                        kategori <span class="font-semibold">"{{ $category_slug }}"</span>
                    @endif
                    @if ($filter_image)
                        gambar <span class="font-semibold">"{{ $filter_image }}"</span>
                    @endif
                    ({{ $products->total() }})
                </p>
                <a href="{{ route('home') }}" class="text-blue-500 hover:underline">Reset</a>
            </div>
        @endif

        @if ($products->total() == 0)
            <p class="font-semibold italic text-lg mb-2">Hasil tidak ditemukan</p>
            @auth
                <a href="{{ route('products.create') }}" class="btn w-fit">Tambah Baru</a>
            @endauth
        @endif

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-1 lg:gap-2">
            @foreach ($products as $product)
                <x-card-product :product="$product" />
            @endforeach
        </div>
        <div class="py-4 paginate">
            {{ $products->onEachSide(1)->links() }}
        </div>
    </div>


</x-layout>
