<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('LogoJustIcon.ico') }}?v={{ time() }}">
</head>

<body>
    @include('layouts.header')


    @if (session('role') === 'admin')
      <div class="button-container">
        <a href="{{ url('/add-article') }}"><button class="add-article">Add a new captivating article</button></a>
      </div>
    @endif
    
    <table>
    <tr>
        <td>Rank</td>
        <td>User</td>
        <td>Score</td>
    </tr>
</table>
    
          
    <footer>
      <p>&copy; 2025 Game Library</p>
    </footer>

  </body>
</html>