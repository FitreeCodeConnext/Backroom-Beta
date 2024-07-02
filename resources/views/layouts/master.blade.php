<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anuphan:wght@100..700&display=swap" rel="stylesheet">
    <title>@yield('title')</title>
    <style>
        body {
            font-family: 'Anuphan', sans-serif;
        }
    </style>
</head>
<body>
    @include('layouts.sidebar')
    <section id="main" class="row">
        <div class="flex flex-col mx-auto">
            <div class="p-4 mt-12 sm:ml-64">
                <div class="w-full bg-white p-4 md:p-6">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
    @yield('scripts')
    
</body>
@include('layouts.footer')
</html>