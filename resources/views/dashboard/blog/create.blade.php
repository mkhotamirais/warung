<x-authlayout title="Buat Blog Baru">
    {{-- session message --}}
    @if (session('success'))
        <x-flash-msg message="{{ session('success') }}"></x-flash-msg>
    @endif

    <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" class="">
        @csrf

        {{-- title --}}
        <div class="mb-3">
            <label for="title" class="label">Title</label>
            <input type="text" class="input !w-full @error('title') !border-red-300 @enderror" name="title"
                id="title" value="{{ old('title') }}" placeholder="Judul blog">
            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- content --}}
        <div class="mb-3">
            <label for="content">Content</label>
            <textarea name="content" id="content" cols="30" rows="10"
                class="input @error('content') !ring-red-500 @enderror">{{ old('content') }}</textarea>
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

        {{-- submit --}}
        <div class="flex gap-2">
            <button type="submit" class="btn">Create</button>
            <a href="{{ url()->previous() }}" class="btn !bg-gray-500">Back</a>
        </div>

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
