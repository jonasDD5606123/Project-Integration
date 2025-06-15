<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite(['resources/js/app.js', 'resources/css/Student/student-dashboard.css'])
    <title>@yield('title', 'Student System')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            background-color: #fff5f5 !important;
        }
    </style>
</head>

<body>
    @include('partials.header')

    <main class="p-6">
        @yield('content')
    </main>
</body>

</html>