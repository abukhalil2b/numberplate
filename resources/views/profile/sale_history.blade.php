<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'طباعة أرقام المركبات') }}</title>
    <style>
        table{
            border: 1px solid #ddd;
        }
        table tr{
            width: 25%;
            border: 1px solid #ddd;
        }
        table td {
            width: 25%;
            border: 1px solid #ddd;
        }
    </style>
</head>

<body>
<h2>
    {{ $date }}
</h2>
    <table>
        @foreach($items as $item)
        <tr>
            <td>{{ $item->required }}</td>
            <td>{{ $item->type }}</td>
            <td>{{ $item->size }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->price }}</td>
        </tr>
        @endforeach
    </table>

</body>

</html>