<!doctype html>
<html lang="en">
<head>
    @include('layouts.head')
</head>
<body class="bg-gray-100 font-main">
@include('layouts.header')
<main>
    @yield('content')
</main>
<footer>
    @include('layouts.footer')
</footer>

<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
