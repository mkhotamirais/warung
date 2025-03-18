<x-authlayout>
    <h1 class="title">Product Category</h1>

    @if (session('success'))
        <x-flash-msg message="{{ session('success') }}" bg="bg-green-500"></x-flash-msg>
    @endif
    @if (session('error'))
        <x-flash-msg message="{{ session('error') }}" bg="bg-red-500"></x-flash-msg>
    @endif

    {{-- form add --}}
    <div class="mb-4">
        <h3 class="text-xl mt-4 py-2">Add Product Category</h3>
        <form action="{{ route('productcats.store') }}" method="POST" class="">
            @csrf

            <div class="mb-4">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="input @error('name') !ring-red-500 @enderror">
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn">Create</button>
        </form>
    </div>

    {{-- product category list --}}
    <div class="mb-4">
        <h3 class="text-xl mt-4 py-2">Product Category List ({{ $productCats->count() }})</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-2">
            @foreach ($productCats as $productCat)
                <div class="py-2" x-data="{ ubah: false }">
                    <p x-show="!ubah">{{ $productCat->name }}</p>
                    <form x-show="ubah" action="{{ route('productcats.update', $productCat) }}" method="POST"
                        class="w-full">
                        @csrf
                        @method('PUT')
                        <input type="text" name="name" id="name" value="{{ $productCat->name }}" autofocus
                            x-ref="inputUbah" class="w-32" />
                        <button type="submit"
                            class="text-xs bg-green-500 text-white rounded-lg px-2 py-1">simpan</button>
                    </form>
                    <div class="text-xs flex gap-2">
                        <button class="text-green-500"
                            @click="ubah = !ubah; if (ubah) $nextTick(() => $refs.inputUbah.focus())"
                            x-text="ubah ? 'kembali' : 'ubah'"></button> |
                        <form action="{{ route('productcats.destroy', $productCat) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-authlayout>
