@props(['blog' => []])

<div class="rounded overflow-hidden sm:flex sm:flex-row sm:gap-6 max-w-3xl">
    <img src="{{ $blog->banner ? asset('storage/' . $blog->banner) : asset('storage/logo/logo-nurul-iman-big.png') }}"
        alt="{{ $blog->title }}" loading="lazy"
        class="{{ $blog->banner ? 'object-cover' : 'object-contain scale-90' }} h-56 sm:h-full w-full sm:w-56 z-30">
    <div class="">
        <a href="{{ route('blogs.show', $blog->slug) }}" class="hover:underline">
            <h3 class="title first-letter:capitalize mt-4 sm:mt-0 !mb-2">{{ $blog->title }}</h3>
        </a>
        <p class="mb-2 text-sm text-gray-500">
            {{ __('common.common.pested-by') }} <a href="{{ route('userBlogs', $blog->user) }}"
                class="text-blue-600">{{ $blog->user->name }}</a>
            {{ $blog->created_at->diffForHumans() }}
        </p>
        <div class="text-gray-700 grow">{!! Str::limit($blog->content, 200) !!}</div>
        <a href="{{ route('blogs.show', $blog->slug) }}" class="btn mt-4">Selengkapnya</a>
        <div class="mt-2">
            {{ $slot }}
        </div>
    </div>
</div>
