<x-layout>
    <section class="py-12">
        <div class="container">

            <h1 class="title text-center">Reset your password</h1>

            <div class="mx-auto max-w-screen-sm card">
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    {{-- email --}}
                    <div class="mb-4">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="{{ old('email') }}"
                            class="input @error('email') !ring-red-500 @enderror">
                        @error('email')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- password --}}
                    <div class="mb-4">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password"
                            class="input @error('password') !ring-red-500 @enderror">
                        @error('password')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- confirm password --}}
                    <div class="mb-4">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="input @error('password') !ring-red-500 @enderror">
                    </div>

                    {{-- submit button --}}
                    <button type="submit" class="btn">Reset password</button>
                </form>
            </div>

        </div>
    </section>
</x-layout>
