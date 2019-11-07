<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <body>
    <form action="/board/put" method="post">
        @csrf
        <input type="text" name="user_name" placeholder="이름" />
        <input type="text" name="contents" placeholder="컨텐츠"/>
        <input type="hidden" name="user_seq" value="t">
        <input type="submit">
    </form>
    </body>
</html>
