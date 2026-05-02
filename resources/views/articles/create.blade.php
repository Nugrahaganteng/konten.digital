@extends('layouts.app')
@section('title', 'Tulis Artikel')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-12">
    <div class="mb-8">
        <p class="text-accent text-xs font-semibold tracking-widest uppercase mb-2">New Post</p>
        <h1 class="font-display text-4xl font-bold text-ink">Tulis Artikel Baru</h1>
        <p class="text-muted mt-2">Artikel akan direview admin sebelum dipublikasikan.</p>
    </div>

    <div class="bg-white rounded-2xl border border-ink/8 p-8 shadow-sm">
        @include('articles.partials.form', [
            'action' => route('articles.store'),
            'method' => 'POST',
        ])
    </div>
</div>
@endsection
