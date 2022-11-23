<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Test task</title>
        @vite('resources/css/app.css')
    </head>
    <body class="h-full grid place-items-center bg-gray-800 text-white">
       <div id="app" class="grid justify-center mt-20"></div>
        @vite('resources/js/app.js')
    </body>
</html>
