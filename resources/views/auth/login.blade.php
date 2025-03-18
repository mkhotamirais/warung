<x-layout>
    <div class="max-w-lg mx-auto shadow-none lg:shadow-md rounded-md my-12 p-4 sm:p-8 bg-white">

        <h1 class="title mb-4">Login</h1>

        @if (session('error'))
            <x-flash-msg message="{{ session('error') }}" bg="bg-red-500"></x-flash-msg>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            {{-- email --}}
            <div class="mb-3">
                <label for="email" class="label">email</label>
                <input type="text" id="email" name="email" autocomplete="off"
                    class="input @error('email') ring-1 ring-red-500 @enderror" value="{{ old('email') }}"
                    placeholder="Email address">
                @error('email')
                    <p class="text-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- password --}}
            <div class="mb-3">
                <label for="password" class="label">password</label>
                <input type="password" id="password" name="password"
                    class="input @error('password') ring-1 ring-red-500 @enderror" value="{{ old('password') }}"
                    placeholder="********">
                @error('password')
                    <p class="text-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- remember me --}}


            <div class="mb-4 flex justify-between items-center">
                <div class="mb-4 flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" class="text-sm font-medium">Remember me</label>
                </div>
                <a href="{{ route('password.request') }}" class="text-xs text-blue-500">Forgot your password?</a>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</x-layout>
