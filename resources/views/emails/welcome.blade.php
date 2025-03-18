<h1>hello {{ $user->name }}</h1>

<div>
    <h2>You created {{ $blog->title }}</h2>
    <p>{{ $blog->body }}</p>

    <img src="{{ $message->embed('storage/' . $blog->banner) }}" alt="{{ $blog->title ?? 'image attachment' }}"
        width="100" height="100">
</div>
