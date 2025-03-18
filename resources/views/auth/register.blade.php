<x-layout>
    <div class="max-w-lg mx-auto shadow-none lg:shadow-md rounded-md my-12 p-2 lg:p-8 bg-white">
        <h1 class="title mb-4">Register</h1>
        <form action="{{ route('register') }}" method="POST">
            @csrf

            {{-- name --}}
            <div class="mb-3">
                <label for="name" class="label">name</label>
                <input type="text" id="name" name="name"
                    class="input @error('name') ring-1 ring-red-500 @enderror" value="{{ old('name') }}"
                    placeholder="Your name">
                @error('name')
                    <p class="text-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- email --}}
            <div class="mb-3">
                <label for="email" class="label">email</label>
                <input type="text" id="email" name="email"
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

            {{-- confirm password --}}
            <div class="mb-6">
                <label for="password_confirmation" class="label">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="input @error('password_confirmation') ring-1 ring-red-500 @enderror"
                    value="{{ old('password') }}" placeholder="********">
            </div>
            <button type="submit" class="btn">Register</button>
        </form>
    </div>
</x-layout>
