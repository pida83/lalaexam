<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <body>
    <form action="/board/set" method="post">
        @csrf
        <input type="text" name="test1" />
        <input type="text" name="test2"/>
        <input type="file" name="file1"/>
        <input type="hidden" name="hidden1" value="hiddenvalue">
        <input type="submit">
    </form>
    </body>
</html>
