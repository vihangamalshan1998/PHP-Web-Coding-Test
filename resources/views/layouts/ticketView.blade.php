<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
     <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900">
    <div class="items-center pt-6 bg-gray-100">
        <div class="flex flex-col items-center">
            <a href="/">
               <img class="mt-2" style="display:inline;width:150px"
                    src="https://www.creativefabrica.com/wp-content/uploads/2020/08/27/Monogram-JR-Logo-V2-Graphics-5156861-1-1-580x386.jpg" />
            </a>
        </div>

        <div class="">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
