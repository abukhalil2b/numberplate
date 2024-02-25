<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'طباعة أرقام المركبات') }}</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid gray;
            text-align: left;
            padding: 12px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .footer {
            display: block;
            height: 50px;
            padding: 50px;
        }

        @media print {

            .hide_print {
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
    <button class="hide_print button" onclick="printDocument();">print | طباعة</button>
    <div style="overflow-y: scroll;">
        <table>
            <thead style="background-color: #737373; color:#fff">
            <tr>
                <td>date and time</td>
                <td>info</td>
                <td>description</td>
                <td>price</td>
            </tr>
            </thead>
            
            <tbody>
            @php
            $extraTotal = 0;
            @endphp
            @foreach($items as $item)
            <tr>
                <td>
                   <div style="font-size:10px"> {{ $item->created_at }}</div>
                    <a class="hide_print" href="{{ route('item.show',$item->bill_id) }}">show</a>
                </td>

                <td>
                    <div style="font-size:10px">{{ $item->type }}</div>
                    <div style="font-size:10px">{{ $item->plate_num }} {{ $item->plate_code }}</div>
                </td>
                <td>{{ $item->description }}</td>
                <td>
                    {{ $item->price }}
                    <div style="font-size:12px;color:#a47b1d">
                        {{ __($item->payment_method) }}
                    </div>
                </td>
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
            </tbody>
        </table>

    </div>
    <div class="footer"></div>
    <script>
        function printDocument() {
            window.print();
        }
    </script>
</body>

</html>