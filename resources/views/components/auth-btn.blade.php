@auth
    <div class="group relative !z-50">
        <button class="capitalize font-bold border-b-2 py-2">{{ auth()->user()->name }}</button>
        <div
            class="opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all scale-0 group-hover:scale-100 origin-top-right border rounded-lg p-2 absolute top-full right-0">
            @if (auth()->user()->role !== 'user')
                <a href="{{ route('dashboard') }}" class="btn mb-2">Dashboard</a>
            @endif
            {{-- logout btn --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" href="" class="btn">Logout</button>
            </form>
        </div>
    </div>
@endauth
