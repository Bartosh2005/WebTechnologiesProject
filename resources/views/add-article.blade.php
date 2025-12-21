<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Game Vault - Add Article</title>

    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('LogoJustIcon.ico') }}?v={{ time() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/add-article.js') }}"></script>

</head>
<body>
    @include('layouts.header')
    <section>    
        <center>
            <h1 style="color:white;">Write your fascinating article</h1><br>
            <h2>Add new article to the newsletter</h2>

            @if ($errors->any())
              <div class="errors">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
              </div>
            @endif

            <form id="article-form" action="{{ route('add-article.add') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-field">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Title" required>
                </div>

                <div class="form-field">
                    <label for="image" class="form-label">Image max 2048 kb</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <div class="form-field">
                    <label for="short_description" class="form-label">Short description</label>
                    <input type="text" name="short_description" id="short_description" class="form-control" placeholder="Description">
                </div>

                <hr style="width:30%; border-color:#444">

                <h3 style="color:white;">Article sections</h3>
                <p style="color:#aaa">Add as many headers and paragraphs as you need.</p>

                <div id="sections-container">
                  <!-- one section template: index 0 -->
                  <div class="section" data-index="0">
                    <div class="form-field">
                      <label class="form-label">Header</label>
                      <input type="text" name="content[0][header]" class="form-control section-header" placeholder="Section header" required>
                    </div>

                    <div class="form-field">
                      <label class="form-label">Paragraph</label>
                      <textarea name="content[0][paragraph]" class="form-control section-paragraph" rows="4" placeholder="Section text" required></textarea>
                    </div>

                    <div class="section-controls">
                      <button type="button" class="btn add-section">+ Add section</button>
                      <button type="button" class="btn remove-section" style="display:none;">- Remove</button>
                    </div>

                    <hr style="width:20%; border-color:#444">
                  </div>
                </div>

                <div style="margin: 20px;">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </center>
    </section>

    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>
  </body>
</html>
