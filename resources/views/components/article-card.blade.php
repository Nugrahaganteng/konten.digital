{{-- resources/views/components/article-card.blade.php --}}
@props(['article'])

<a href="{{ route('articles.show', $article->slug) }}"
   class="group block bg-white rounded-2xl overflow-hidden border border-ink/8 hover:border-accent/30 transition-all hover:shadow-lg">

    {{-- Thumbnail --}}
    <div class="aspect-video overflow-hidden">
        <img src="{{ $article->thumbnail_url }}"
             alt="{{ $article->title }}"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
    </div>

    {{-- Content --}}
    <div class="p-5">
        <span class="inline-block bg-accent/10 text-accent text-xs font-semibold px-2.5 py-1 rounded-full mb-3">
            {{ $article->category }}
        </span>
        <h3 class="font-display font-bold text-ink text-lg leading-snug mb-2 group-hover:text-accent transition-colors line-clamp-2">
            {{ $article->title }}
        </h3>
        <p class="text-muted text-sm leading-relaxed line-clamp-2 mb-4">
            {{ $article->excerpt }}
        </p>
        <div class="flex items-center gap-2 text-xs text-muted">
            <div class="w-6 h-6 rounded-full bg-ink/10 flex items-center justify-center font-bold text-ink text-xs">
                {{ substr($article->user->name, 0, 1) }}
            </div>
            <span>{{ $article->user->name }}</span>
            <span>·</span>
            <span>{{ $article->published_at->diffForHumans() }}</span>
        </div>
    </div>
</a>
