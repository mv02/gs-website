<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tableName }} | GS Database</title>
    <style>
        table {
            text-align: center;
            border-spacing: 0;
        }
        th, td {
            border: 1px solid black;
            padding: 4px;
        }
    </style>
</head>
<body>
    @if (count($data) == 0)
        <p>No results.</p>
    @else
        <table>
            <thead>
                <tr>
                    @foreach ($keys as $key)
                        <th>{{ $key }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        @foreach ($keys as $key)
                            <td>{{ $row[$key] }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody> 
        </table>
    @endif

    <ul>
        <li><a href="/employees">Employees</a></li>
        <li><a href="/customers">Customers</a></li>
        <li><a href="/orders">Orders</a></li>
        <li><a href="/storages">Storages</a></li>
    </ul>
</body>
</html>