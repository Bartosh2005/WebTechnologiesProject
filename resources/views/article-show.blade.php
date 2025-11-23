<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{ $article->title }} - Game Vault</title>
  <link rel="stylesheet" href="{{ asset('css/article.css') }}">
  <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
  @include('layouts.header')

  <main class="article-container">
    <div class="article-hero" style="background-image: url('{{ $article->image ? asset('storage/' . $article->image) : '/images/default.jpg' }}')">
      <div class="article-overlay">
        @if(session('role') === 'admin')
          <div class="article-admin-controls" style="margin-top:20px;">
            <a href="{{ route('articles.edit', $article->id) }}" class="btn-edit">
              Edit Article
             </a>

            <form action="{{ route('articles.delete', $article->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
              @csrf
              <button type="submit" class="btn-delete">Delete</button>
            </form>
          </div>
        @endif

        <h1>{{ $article->title }}</h1>
        
        @if($article->short_description)
          <p>{{ $article->short_description }}</p>
        @endif
      </div>
    </div>

    <article class="article-content">
      @foreach($article->content ?? [] as $section)
        @if(!empty($section['header']))
          <h2>{{ $section['header'] }}</h2>
        @endif

        @if(!empty($section['paragraph']))
          <p>{!! nl2br(e($section['paragraph'])) !!}</p>
        @endif
      @endforeach
    </article>
  </main>

  <footer>
    <p>&copy; 2025 Game Vault</p>
  </footer>
</body>
</html>
