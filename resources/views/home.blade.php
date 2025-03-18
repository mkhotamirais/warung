<x-layout>
    {{-- hero --}}
    <section class="relative">
        <img class="absolute inset-0 w-full h-full object-cover object-center"
            src="{{ asset('storage/img/hero-warungota.jpg') }}" alt="Hero Image untuk warungota" />
        <div class="relative h-screen bg-black/50">
            <div class="container flex items-center justify-center h-full text-center">
                <article
                    class="flex flex-col justify-center items-center text-center text-white -translate-y-5 max-w-4xl">
                    <h1 class="text-4xl lg:text-6xl text-white">{{ __('common.home.hero.title') }}</h1>
                    <p class="leading-relaxed text-base lg:text-lg text-white mt-4 mb-8">
                        {{ __('common.home.hero.description') }}</p>
                    <div class="flex flex-col lg:flex-row gap-4 mt-4">
                        <a href="{{ route('product') }}" class="btn-lg">{{ __('common.common.btn-products') }}</a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    {{-- produk --}}
    <section class="py-12">
        <div class="container">
            <div class="flex items-center justify-between mb-4">
                <h2 class="title">Produk</h2>
                <a href="{{ route('product') }}">
                    <x-heroicon-o-arrow-right-circle class="size-8" />
                </a>
            </div>
            <div class="flex overflow-x-scroll gap-2">
                @foreach ($products as $item)
                    <div class="min-w-56">
                        <x-card-product :product="$item" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- contact --}}
    <section class="py-12 bg-blue-600">
        <div class="container flex flex-col lg:flex-row justify-between items-center">
            <h2 class="mb-4 lg:mb-0 title max-w-3xl !text-white text-center lg:text-left">
                {{ __('common.home.contact.title') }}</h2>
            <a href="{{ config('common.links.wa') }}" class="btn-lg">{{ __('common.common.btn-contact') }}</a>
        </div>
    </section>

    {{-- blog --}}
    <section class="py-12">
        <div class="container">
            <div class="flex items-center justify-between mb-4">
                <h2 class="title">Blog</h2>
                <a href="{{ route('blog') }}">
                    <x-heroicon-o-arrow-right-circle class="size-8" />
                </a>
            </div>
            <div class="flex overflow-x-scroll gap-2">
                @foreach ($blogs as $item)
                    <div class="min-w-56 relative">
                        <img src="{{ $item->banner ? asset('storage/' . $item->banner) : asset('storage/img/logo-warungota.png') }}"
                            alt="" class="h-56 object-cover object-center w-full rounded-t-lg">
                        <a href="{{ route('blogs.show', $item->slug) }}">
                            <h3 class="capitalize font-semibold hover:underline mt-2">{{ $item->title }}</h3>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


</x-layout>
