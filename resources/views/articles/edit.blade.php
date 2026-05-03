{{-- resources/views/articles/edit.blade.php --}}
@extends('layouts.app')
@section('title', 'Edit Artikel')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-12">
    <div class="mb-8">
        <p class="text-accent text-xs font-semibold tracking-widest uppercase mb-2">Edit Post</p>
        <h1 class="font-display text-4xl font-bold text-ink">Edit Artikel</h1>
        <p class="text-muted mt-2">Setelah diedit, artikel akan kembali ke status draft dan perlu review ulang.</p>
    </div>

    <div class="bg-white rounded-2xl border border-ink/8 p-8 shadow-sm">
        @include('articles.partials.form', [
            'article' => $article,
            'action'  => route('articles.update', $article),
            'method'  => 'PUT',
        ])
    </div>
</div>
    @include('articles.partials.form', [
        'action'  => route('articles.update', $article),
        'article' => $article,
    ])
@endsection
