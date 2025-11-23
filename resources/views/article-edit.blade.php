<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Article - Game Vault</title>

    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('LogoJustIcon.ico') }}?v={{ time() }}">
</head>

<body>
@include('layouts.header')

<section>
    <center>
        <h1 style="color:white;">Edit Article</h1>
        <h2>Update your content</h2>

        <form action="{{ route('articles.saveEdit', $article->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

           
            <div class="form-field">
                <label for="title" class="form-label">Title</label>
                <input type="text"
                       name="title"
                       id="title"
                       class="form-control"
                       value="{{ $article->title }}"
                       required>
            </div>

         
            <div class="form-field">
                <label for="short_description" class="form-label">Short Description</label>
                <input type="text"
                       name="short_description"
                       id="short_description"
                       class="form-control"
                       value="{{ $article->short_description }}">
            </div>

            
            <div class="form-field">
                <label for="image" class="form-label">Change Image</label>

                <input type="file" name="image" id="image" class="form-control">

                @if($article->image)
                    <p style="margin-top:10px;">
                        <strong>Current Image:</strong><br>
                        <img src="{{ asset('storage/'.$article->image) }}"
                             style="width:200px; border-radius:10px; margin-top:5px;">
                    </p>
                @endif
            </div>

          
            <h2 style="color:white; margin-top:30px;">Edit Article Sections</h2>

            <div id="content-sections">

                @foreach($article->content as $index => $section)
                    <div class="content-block" style="margin-bottom:30px; padding:20px; border:1px solid #333; border-radius:10px;">

                       
                        <div class="form-field">
                            <label class="form-label">Header</label>
                            <input type="text"
                                   name="content[{{ $index }}][header]"
                                   class="form-control"
                                   value="{{ $section['header'] ?? '' }}">
                        </div>

                       
                        <div class="form-field">
                            <label class="form-label">Paragraph</label>
                            <textarea name="content[{{ $index }}][paragraph]"
                                      class="form-control"
                                      rows="4">{{ $section['paragraph'] ?? '' }}</textarea>
                        </div>

                    </div>
                @endforeach

            </div>

    
            <button type="button" id="add-section-btn" class="btn btn-secondary" style="margin-top:20px;">
                + Add New Section
            </button>


            <button type="submit" class="btn btn-primary" style="margin-top:30px;">
                Save Changes
            </button>

        </form>
    </center>
</section>


<footer>
    <p>&copy; 2025 Game Vault</p>
</footer>


<script>
document.getElementById('add-section-btn').addEventListener('click', function () {
    const container = document.getElementById('content-sections');
    const index = container.children.length;

    const block = document.createElement('div');
    block.className = 'content-block';
    block.style = "margin-bottom:30px; padding:20px; border:1px solid #333; border-radius:10px;";

    block.innerHTML = `
        <div class="form-field">
            <label class="form-label">Header</label>
            <input type="text" name="content[${index}][header]" class="form-control">
        </div>

        <div class="form-field">
            <label class="form-label">Paragraph</label>
            <textarea name="content[${index}][paragraph]" class="form-control" rows="4"></textarea>
        </div>
    `;

    container.appendChild(block);
});
</script>

</body>
</html>
