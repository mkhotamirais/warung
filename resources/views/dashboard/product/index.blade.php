<x-authlayout>
    <div class="flex justify-between items-center mb-2">
        <h1 class="title !mb-0">Product</h1>
        <a href="{{ route('products.create') }}" class="btn">Add New</a>
    </div>

    @if (session('success'))
        <x-flash-msg message="{{ session('success') }}" bg="bg-green-500"></x-flash-msg>
    @endif

    {{-- your products --}}
    <div>
        <h2 class="text-xl font-semibold mb-2">Your Products ({{ $myProducts->total() }})</h2>

        <form class="mb-2">

            {{-- @if (request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif --}}

            {{-- @if (request('sort'))
                <input type="hidden" name="sort" value="{{ request('sort') }}">
            @endif

            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif --}}

            <div class="items-center flex sm:space-y-0">
                <div class="relative w-full">
                    <label for="search"
                        class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cari</label>
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <x-bi-search class="w-5 h-5 text-gray-500 dark:text-gray-400"></x-bi-search>
                    </div>
                    <input type="search" name="search" autocomplete="off" value="{{ $search }}"
                        class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-l-lg focus:ring-primary-500 focus:border-primary-500"
                        placeholder="Cari" type="text" id="search">
                </div>
                <div>
                    <button type="submit"
                        class="rounded-l-none py-3 px-5 text-sm font-medium text-center text-white border cursor-pointer bg-blue-500 transition hover:bg-blue-600  rounded-r-lg focus:ring-4 focus:ring-blue-300">
                        Cari
                    </button>
                </div>
            </div>
        </form>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-4">
            @foreach ($myProducts as $product)
                <x-product-card :product="$product">
                    <div class="mt-auto flex justify-end gap-1 items-center bg-gray-100 p-2 border-t">
                        {{-- update product --}}
                        <a href="{{ route('products.edit', $product) }}"
                            class="bg-green-500 hover:bg-green-600 py-1 px-3 rounded-full text-white text-sm">Ubah</a>
                        {{-- delete product --}}
                        <form action="{{ route('products.destroy', $product) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Are you sure?')" type="submit"
                                class="bg-red-500 hover:bg-red-600 py-1 px-3 rounded-full text-white text-sm">Hapus</button>
                        </form>
                    </div>
                </x-product-card>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $myProducts->links() }}
        </div>
    </div>

    {{-- all products --}}
    <div>
        <h2 class="text-xl font-semibold mb-2">All Product ({{ $products->total() }})</h2>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-4">
            @foreach ($products as $product)
                <x-product-card :product="$product"></x-product-card>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</x-authlayout>
