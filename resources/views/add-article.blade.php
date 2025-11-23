<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/add-article.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('LogoJustIcon.ico') }}?v={{ time() }}">
</head>
<body>
    @include('layouts.header')
        <section>    
            <center>
                <h1 style="color:white;">Write your fascinating article</h2><br>
                <h2>Add new article to the newsletter</h2>
                <form action="{{ route('add-article.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    
                    <div class="form-field">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Title" required>
                    </div>
                    
                    
                    <div class="form-field">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>

                    
                    <div class="form-field">
                        <label for="genre" class="form-label">Short description</label>
                        <input type="text" name="genre" id="genre" class="form-control">
                    </div>

                    
                    <div class="form-field">
                        <label for="year" class="form-label">Header</label>
                        <input type="number" name="year" id="year" class="form-control">
                    </div>


                    
                    <div class="form-field">
                        <label for="description" class="form-label">Article</label>
                        <textarea name="description" id="description" rows="4" class="form-control"></textarea>
                    </div>


                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </center>
        </section>


    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>

  </body>
</html>