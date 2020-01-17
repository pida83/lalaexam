<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <body>
    <table>
        <thead>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $row)
            <tr>
                <td>{{$row->user_name}}</td>
                <td>{{$row->contents}}</td>
                <td></td>
                <td></td>
            </tr>
            @endforeach;
        </tbody>
    </table>
    </body>
</html>
