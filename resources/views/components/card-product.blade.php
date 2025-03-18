@props(['product' => []])

<div class="relative border transition rounded-lg overflow-hidden flex flex-col bg-white h-full">
    @if ($product->banner)
        <img src="{{ asset('storage/' . $product->banner) }}" alt="{{ $product->title ?? 'product banner' }}"
            class="object-cover object-center w-full h-40 lg:h-52 bg-gray-100">
    @endif

    <div class="relative p-2 flex flex-col">
        <div class="flex justify-between gap-2">
            <div class="grow">
                <h3 class="text capitalize leading-tight mb-2 grow">{{ Str::limit($product->name, 20, '...') }}</h3>
                <div class="badge">{{ $product->productcat->name }}</div>
                <p class="text-lg font-semibold">Rp{{ number_format($product->price, 0, ',', '.') }}
                </p>
                <div class="text-content !mt-0">
                    {{ $product->price_details }}
                </div>
            </div>
        </div>
    </div>
    {{ $slot }}
</div>
