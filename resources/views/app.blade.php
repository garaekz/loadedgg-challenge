<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Loaded GG</title>
        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </head>
    <body class="bg-slate-950 text-slate-200">
        <div id="app"></div>
    </body>
</html>
