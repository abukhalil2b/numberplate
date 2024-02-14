<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'طباعة أرقام المركبات') }}</title>
    <style>
        .footer {
            display: block;
            height: 50px;
            padding: 50px;
        }

        body {
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        table {
            border: 1px solid #ddd;
            margin: 5px;
        }

        table tr {
            width: 100%;
            border: 1px solid #ddd;
        }

        table td {
            font-size: 12px;
            padding: 6px 3px;
            width: 30%;
            border: 1px solid #ddd;
        }

        @media print {

            .hidebutton {
                display: none !important;
            }
        }

        button {
            background-color: #04AA6D;
            /* Green */
            border: none;
            color: white;
            padding: 5px 2px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <h2>
        {{ $date }}
    </h2>
    <button class="hidebutton button" onclick="printDocument();">print | طباعة</button>
    <table>
        <tr>
            <td>date and time</td>
            <td>info</td>
            <td>description</td>
            <td>price</td>
        </tr>
        @php
        $extraTotal = 0;
        @endphp
        @foreach($items as $item)
        <tr>
            <td>{{ $item->created_at }}</td>
            <td>
                <div style="font-size:10px">{{ $item->type }}</div>
                <div style="font-size:10px">{{ $item->plate_num }} {{ $item->plate_code }}</div>
            </td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->price }}</td>
        </tr>
        @php
        $extraTotal = $extraTotal + $item->price;
        @endphp
        @endforeach
        <tr>
            <td colspan="4">
                <h2 style="text-align:center"> {{ $extraTotal }}</h2>
            </td>
        </tr>
    </table>
    <div class="footer"></div>
    <script>
        function printDocument() {
            window.print();
        }
    </script>
</body>

</html>