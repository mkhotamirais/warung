<x-layout>
    <section class="py-12">
        <div class="container">

            <h1 class="title text-center">Request a password reset email</h1>

            <div class="mx-auto max-w-screen-sm card">
                @if (session('status'))
                    <x-flash-msg msg="{{ session('status') }}" />
                @endif


                <form action="{{ route('password.request') }}" method="POST">
                    @csrf

                    {{-- email --}}
                    <div class="mb-4">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="{{ old('email') }}"
                            class="input @error('email') !ring-red-500 @enderror">
                        @error('email')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- submit button --}}
                    <button type="submit" class="btn">Submit</button>
                </form>
            </div>
        </div>
    </section>

</x-layout>
