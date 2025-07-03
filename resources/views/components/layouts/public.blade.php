<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mata & Kris</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="leaf-container"></div>

    @include('components.layouts.partials.header')

    <main>
        @yield('content')
    </main>

    @include('components.layouts.partials.footer')
</body>
</html>