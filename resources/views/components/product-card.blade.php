@props(['product' => []])

<div x-data="{ show: false }" x-on:mouseenter="show = true" x-on:mouseleave="show = false"
    class="relative border transition rounded-lg overflow-hidden flex flex-col">
    @if ($product->banner)
        <img src="{{ asset('storage/' . $product->banner) }}" alt="{{ $product->title ?? 'product banner' }}"
            class="object-cover object-center w-full h-40 bg-gray-100">
    @endif

    <div class="relative p-2 flex flex-col">
        <div class="flex justify-between gap-2">
            <div class="grow">
                <h3 class="text capitalize leading-tight mb-2 grow">{{ Str::words($product->name, 6, '...') }}</h3>
                <div class="badge">{{ $product->productcat->name }}</div>
                <p class="text-lg font-semibold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
            </div>
            <x-bi-chevron-down class="size-4" />
        </div>
        <div :class="show ? 'block' : 'hidden'" class="transition text-sm space-y-2 mt-2">
            <div class="text-content text-sm grow">
                {{ $product->price_details }}
            </div>
            <div class="text-content text-sm grow">
                {{ $product->description }}
                {{-- {!! Str::words($product->de, 16, '...') !!} --}}
            </div>
            <p class="text-xs text-gray-500">Dibuat oleh {{ $product->user->name }}
                {{ $product->created_at->diffForHumans() }}</p>

        </div>
    </div>
    {{ $slot }}
</div>
