<x-authlayout>
    <h1 class="title">Create New Product</h1>

    {{-- Session Messages --}}
    @if (session('success'))
        <x-flash-msg message="{{ session('success') }}"></x-flash-msg>
    @endif

    <form action="{{ route('products.store') }}" method="POST" class="" enctype="multipart/form-data">
        @csrf

        {{-- product name --}}
        <div class="mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="input @error('name') !ring-red-500 @enderror">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- product price --}}
        <div class="mb-3">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}"
                class="input @error('price') !ring-red-500 @enderror">
            @error('price')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- product price_details --}}
        <div class="mb-3">
            <label for="price_details">Price Details</label>
            <textarea name="price_details" id="price_details" cols="30" rows="2"
                class="input @error('price_details') !ring-red-500 @enderror">{{ old('price_details') }}</textarea>
            @error('price_details')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- product description --}}
        <div class="mb-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="2"
                class="input @error('description') !ring-red-500 @enderror">{{ old('description') }}</textarea>
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
                    <option value="{{ $bc->id }}">{{ $bc->name }}</option>
                @endforeach
            </select>
            @error('productcat_id')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="banner">Banner</label>
            <input type="file" name="banner" id="banner" class="input @error('banner') !ring-red-500 @enderror">
            @error('banner')
                <p class="error">{{ $message }}</p>
            @enderror
            <div id="preview-container" class="mt-2 hidden">
                <img id="image-preview" src="" class="w-40 h-auto rounded shadow-md">
                <button type="button" id="remove-image"
                    class="text-red-500 hover:underline text-sm mt-1">Remove</button>
            </div>
        </div>

        <button type="submit" class="btn">Create</button>

        <script>
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

    </form>
</x-authlayout>
