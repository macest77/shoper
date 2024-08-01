
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Aplikacja rekrutacyjna</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Aplikacja rekrutacyjna">
        <meta name="keywords" content="">
        <meta name="author" content="Marcin Stefanski">
    
        <!-- CSS And JavaScript -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        @yield('scripts')

    </head>

    <body class="antialiased" >
        <h1>Aplikacja rekrutacyjna</h1>
        <h2>Pets</h2>
        @yield('content')
        <footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark text-white-50">
            <div class="container text-center">
                <small>Copyright &copy; marcinstefanski - marcinstefanski.pl</small>
            </div>
        </footer>
        
    </body>
</html>
