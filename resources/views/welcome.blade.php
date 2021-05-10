<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased">
        <p>Agile, scrum... Fuck you I am Russin? huyak, huyak and v production</p>
        <div class="max-w-sm mx-auto py-8">
            <form action="/api/test" method="post" enctype="multipart/form-data">
                <input type="file" name="image" id="image">
                <button type="submit">Upload</button>
            </form>
        </div>
    </body>
</html>
