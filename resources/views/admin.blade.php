<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Vault</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/addbutton.js') }}"></script>
    <script src="{{ asset('js/library-search.js') }}"></script>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('LogoJustIcon.ico') }}?v={{ time() }}">
</head>


<body>
    @include('layouts.header')

    <main>
        <section>    
            <center>
                <h1 style="color:white;">Welcome to the admin panel</h2><br>
                <h2>Add new game to the library</h2>
                <form action="{{ route('admin.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="form-field">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Title" required>
                    </div>

                    <!-- Genre -->
                    <div class="form-field">
                        <label for="genre" class="form-label">Genre</label>
                        <input type="text" name="genre" id="genre" class="form-control">
                    </div>

                    <!-- Year -->
                    <div class="form-field">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" name="year" id="year" class="form-control">
                    </div>

                    <!-- Company -->
                    <div class="form-field">
                        <label for="company" class="form-label">Company</label>
                        <input type="text" name="company" id="company" class="form-control">
                    </div>

                    <!-- Description -->
                    <div class="form-field">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" rows="4" class="form-control"></textarea>
                    </div>

                    <!-- Tags -->
                    <div class="form-field">
                        <label for="tags" class="form-label">Tags (comma separated)</label>
                        <input type="text" name="tags" id="tags" class="form-control">
                    </div>

                    <!-- Image -->
                    <div class="form-field">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </center>
        </section>

        <footer>
            <p>&copy; 2025 Game Library</p>
        </footer>
        
    </main>
</body>
</html>