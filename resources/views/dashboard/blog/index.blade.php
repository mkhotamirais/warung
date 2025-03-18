<x-authlayout>
    <div class="flex justify-between items-center mb-2">
        <h1 class="title !mb-0">Blog</h1>
        <a href="{{ route('blogs.create') }}" class="btn">Add Blog</a>
    </div>

    @if (session('success'))
        <x-flash-msg message="{{ session('success') }}" bg="bg-green-500"></x-flash-msg>
    @endif

    <article class="grid grid-cols-1 gap-2 lg:gap-4">
        @foreach ($myBlogs as $item)
            <x-card-blog :blog="$item">
                <div class="flex gap-2">

                    <a href="{{ route('blogs.edit', $item->slug) }}"
                        class="btn !bg-green-500 hover:!bg-green-600">Edit</a>
                    <form action="{{ route('blogs.destroy', $item->slug) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" type="submit"
                            class="btn !bg-red-500 hover:!bg-red-600">Hapus</button>
                    </form>
                </div>
            </x-card-blog>
        @endforeach
    </article>
</x-authlayout>
