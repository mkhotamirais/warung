<div class="relative group w-fit">
    <button class="rounded-full shadow p-2 hover:scale-110 transition">
        <x-bi-translate class="w-6 h-6" />
    </button>
    <div class="absolute right-0 top-full pt-2 group-hover:scale-100 scale-0 origin-top-right transition">
        <div class="p-3 bg-white border rounded flex flex-col gap-2">
            <a href="{{ route('set-locale', 'id') }}"
                class="hover:text-orange-500 {{ session('locale') == 'id' ? 'text-orange-500' : '' }}">Indonesia</a>
            <a href="{{ route('set-locale', 'en') }}"
                class="hover:text-orange-500 {{ session('locale') == 'en' ? 'text-orange-500' : '' }}">English</a>
        </div>
    </div>
</div>
