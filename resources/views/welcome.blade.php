<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <button id="google-login">Login dengan Google</button>

    <script>
        document.getElementById('google-login').addEventListener('click', function() {
            // Request ke backend untuk mendapatkan URL otorisasi
            fetch('/google-auth-url')
                .then(response => response.json())
                .then(data => {
                    // Redirect pengguna ke URL otorisasi Google
                    window.location.href = data.data; // Gunakan key 'data' dari response
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>


</body>

</html>
