<x-authlayout>
    <h1 class="title">Halo, {{ auth()->user()->name ?? '' }} your are {{ auth()->user()->role }}</h1>
</x-authlayout>
