<x-layout>
    <section class="py-12">
        <div class="container text-center">
            <h1 class="mb-4">Please verify your email through the email we've sent you</h1>
            <p>Didn't get the email?</p>
            <form action="{{ route('verification.send') }}" method="POST" class="">
                @csrf
                <button type="submit" class="btn mx-auto">Send again</button>
            </form>
        </div>
    </section>
</x-layout>
