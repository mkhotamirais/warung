@props(['message' => 'Message', 'bg' => 'bg-green-500'])

<div class="mb-2">
    <p class="text-sm text-white rounded-lg px-4 py-3 {{ $bg }}">{{ $message }}</p>
</div>
