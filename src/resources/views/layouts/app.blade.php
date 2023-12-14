<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
</head>

<body>
    @yield('header')
    <main class="main">
        @yield('content')
        <footer class="footer">
            <div class="footer__inner">
                <p class="footer__inc">Atte, inc.</p>
            </div>
        </footer>
    </main>
    
</body>

</html>