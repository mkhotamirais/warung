<x-layout>
    {{-- search --}}
    <div class="sticky top-16 py-2 bg-gray-100 z-50">
        <div class="container">
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

                <div class="items-center flex sm:space-y-0">
                    <div class="relative w-full">
                        <label for="search"
                            class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cari</label>
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <x-bi-search class="w-5 h-5 text-gray-500 dark:text-gray-400"></x-bi-search>
                        </div>
                        <input type="search" name="search" autocomplete="off" value="{{ $search }}"
                            class="block p-3 pl-10 w-full text-sm text-gray-900 bg-white border border-gray-300 rounded-l-lg focus:ring-primary-500 focus:border-primary-500"
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
                <x-product-card :product="$product" />
            @endforeach
        </div>
        <div class="py-4 paginate">
            {{ $products->onEachSide(1)->links() }}
        </div>
    </div>

    {{-- filter and sort --}}
    <div class="py-2 bg-gray-100 fixed bottom-0 h-auto left-0 right-0 z-50">
        <div class="container flex items-center justify-around gap-1">
            <button x-on:click="showFilter = !showFilter" type="button"
                class="flex gap-1 items-center justify-center border w-full rounded py-1 bg-white hover:bg-gray-50">
                <x-fas-filter class="size-4" />
                Filter
            </button>

            {{-- close all --}}
            <button x-show="showFilter || showShort" x-on:click="showFilter = false; showShort = false" type="button"
                class="flex gap-1 px-2 h-full items-center justify-center border rounded py-1 bg-white hover:text-red-500">
                <x-bi-x class="size-6" /></button>

            <button x-on:click="showShort = !showShort"
                class="flex gap-1 items-center justify-center border w-full rounded py-1 bg-white hover:bg-gray-50">
                <x-fas-sort class="size-4" />
                sort
            </button>
        </div>
        <div class="container">

            {{-- show filter --}}
            <div x-show="showFilter" class="bg-white mt-1 p-2 border rounded">
                <h3 class="text-gray-600 mb-2">Filter</h3>
                <h4 class="text-sm pb-1">Category</h4>
                <x-badge-cat :totalCats="$totalCats" :total="$total" :cats="$productcats" />
                <h4 class="text-sm pb-1">Image</h4>
                <x-badge-sorting name="filter_image" :sorting="config('common.filter-image')" />
            </div>
            {{-- show sort --}}
            <div x-show="showShort" class="bg-white mt-1 p-2 border rounded">
                <span class="text-sm text-gray-600 mb-2 inline-block">Sort</span>
                <x-badge-sorting name="sort" :sorting="config('common.sorting')" />
            </div>
        </div>
    </div>

</x-layout>
