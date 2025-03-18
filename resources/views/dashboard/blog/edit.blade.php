<x-authlayout title="Update Berita">
    {{-- session message --}}
    @if (session('success'))
        <x-flash-msg message="{{ session('success') }}"></x-flash-msg>
    @endif

    <form action="{{ route('blogs.update', $blog) }}" method="POST" enctype="multipart/form-data" class="">
        @csrf
        @method('PUT')

        {{-- title --}}
        <div class="mb-3">
            <label for="title" class="label">Title</label>
            <input type="text" class="input !w-full @error('title') !border-red-300 @enderror" name="title"
                id="title" value="{{ $blog->title }}" placeholder="Judul berita">
            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- content --}}
        <div class="mb-3">
            <label for="content">Content</label>
            <textarea name="content" id="content" cols="30" rows="10"
                class="input @error('content') !ring-red-500 @enderror">{{ $blog->content }}</textarea>
            @error('content')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <script>
            ClassicEditor
                .create(document.querySelector('#content'))
                .catch(error => {
                    console.error(error);
                });
        </script>

        {{-- banner --}}
        @if ($blog->banner)
            <label>Current banner</label>
            <figure class="h-40 w-64 rounded-md mb-4 overflow-hidden">
                <img id="current-image" src="{{ asset('storage/' . $blog->banner) }}"
                    alt="{{ $blog->title ?? 'Blog Image' }}" width="400" height="400"
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

        {{-- submit --}}
        <div class="flex gap-2">
            <button type="submit" class="btn">Save</button>
            <a href="{{ url()->previous() }}" class="btn !bg-gray-500">Back</a>
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
    </form>
</x-authlayout>
