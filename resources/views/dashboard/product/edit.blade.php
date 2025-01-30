<x-authlayout>
    <h1 class="title">Update Product</h1>

    {{-- Session Messages --}}
    @if (session('success'))
        <x-flash-msg message="{{ session('success') }}"></x-flash-msg>
    @endif

    <form action="{{ route('products.update', $product) }}" method="POST" class="" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- product name --}}
        <div class="mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $product->name }}"
                class="input @error('name') !ring-red-500 @enderror">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- product price --}}
        <div class="mb-3">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" value="{{ number_format($product->price, 0, '', '') }}"
                class="input @error('price') !ring-red-500 @enderror">
            @error('price')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- product price_detail --}}
        <div class="mb-3">
            <label for="price_detail">Price Detail</label>
            <textarea name="price_detail" id="price_detail" cols="30" rows="2"
                class="input @error('price_detail') !ring-red-500 @enderror">{{ $product->price_details }}</textarea>
            @error('price_detail')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- product description --}}
        <div class="mb-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="2"
                class="input @error('description') !ring-red-500 @enderror">{{ $product->description }}</textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- product cat --}}
        <div class="mb-3">
            <label for="productcat_id">Category</label>
            <a href="{{ route('productcats.index') }}" class="text-sm text-orange-500 hover:underline">tambah
                category</a>
            <select class="select @error('productcat_id') !ring-red-500 @enderror" name="productcat_id"
                id="productcat_id">
                <option value="1">-- Select Category</option>
                @foreach ($productCategories as $bc)
                    <option value="{{ $bc->id }}" {{ $product->productcat_id == $bc->id ? 'selected' : '' }}>
                        {{ $bc->name }}</option>
                @endforeach
            </select>
            @error('productcat_id')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- product banner --}}
        {{-- <div class="mb-3">
            <label for="banner">Banner</label>
            <input type="file" name="banner" id="banner" class="input @error('banner') !ring-red-500 @enderror">
            @error('banner')
                <p class="error">{{ $message }}</p>
            @enderror
        </div> --}}

        @if ($product->banner)
            <label>Current banner</label>
            <figure class="h-40 w-64 rounded-md mb-4 overflow-hidden">
                <img id="current-image" src="{{ asset('storage/' . $product->banner) }}"
                    alt="{{ $product->name ?? 'Product Image' }}" width="400" height="400"
                    class="w-full h-full object-cover origin-center">
            </figure>

            {{-- Checkbox untuk menghapus gambar --}}
            <div class="mb-3">
                <input type="checkbox" name="delete_banner" id="delete_banner" value="1">
                <label for="delete_banner" class="text-red-500">Delete current image</label>
            </div>
        @endif

        {{-- Preview Gambar Baru --}}
        <div class="mb-3">
            <label for="banner">Banner</label>
            <input type="file" name="banner" id="banner" class="input @error('banner') !ring-red-500 @enderror"
                onchange="previewImage(event)">
            @error('banner')
                <p class="error">{{ $message }}</p>
            @enderror
            <div id="preview-container" class="mt-2 hidden">
                <img id="image-preview" src="" class="w-40 h-auto rounded shadow-md">
                <button type="button" id="remove-image"
                    class="text-red-500 hover:underline text-sm mt-1">Remove</button>
            </div>
        </div>

        <script>
            function previewImage(event) {
                const input = event.target;
                const previewContainer = document.getElementById('preview-container');
                const previewImage = document.getElementById('preview-image');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewContainer.classList.remove('hidden');
                        previewImage.src = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            document.addEventListener("DOMContentLoaded", function() {
                const fileInput = document.getElementById("banner");
                const previewContainer = document.getElementById("preview-container");
                const imagePreview = document.getElementById("image-preview");
                const removeButton = document.getElementById("remove-image");

                fileInput.addEventListener("change", function() {
                    const file = this.files[0];

                    if (file) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            imagePreview.src = e.target.result;
                            previewContainer.classList.remove("hidden");
                        };

                        reader.readAsDataURL(file);
                    }
                });

                removeButton.addEventListener("click", function() {
                    fileInput.value = ""; // Reset file input
                    imagePreview.src = "";
                    previewContainer.classList.add("hidden");
                });
            });
        </script>
        <button type="submit" class="btn">Save</button>

    </form>
</x-authlayout>
