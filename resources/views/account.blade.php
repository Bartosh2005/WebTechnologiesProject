<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/library.css') }}">
    <link rel="stylesheet" href="{{ asset('css/libraryl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('Logo.ico') }}?v={{ time() }}">
</head>

<body>
    <header>
        <a href="{{ url('/welcome') }}"><img src="{{ asset('image/Logo.png') }}" alt="Logo" style="width: 150px;"></a>
        <a href="{{ url('/library') }}"><h1>MyGamebrowser</h1></a>
        <a href="{{ url('/newsletter') }}"><h1>MyNewsletter</h1></a>
        <a href="{{ url('/collection') }}"><h1>MyCollection</h1></a>
         <a href="{{ url('/account') }}"><button class="MyAccount-button">MyAccount</button></a>
    </header>

   <main>
    <div class="login-container" class="lessmargin">
        <h2>Login</h2>
        <form id="loginForm">
            <input type="text" id="username" placeholder="Username" required>
            <input type="password" id="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p id="error-message" style="color: rgb(248, 126, 126); display: none;">Invalid username or password!</p>
    </div>
    
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting the traditional way
    
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
    
            // Hardcoded username and password for demo purposes
            const correctUsername = "Bartosz";
            const correctPassword = "JokingLegend1";
    
            if (username === correctUsername && password === correctPassword) {
                // Redirect to the next page after successful login
                window.location.href = "collection"; // Redirect to programs.html
            } else {
                // Show an error message
                document.getElementById('error-message').style.display = "block";
            }
        });
    </script>

    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>