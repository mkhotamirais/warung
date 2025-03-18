<x-layout>
    <section class="py-12">
        <div class="container">
            @foreach ($userBlogs as $item)
                <x-card-blog :blog="$item" />
            @endforeach
        </div>
    </section>
</x-layout>
