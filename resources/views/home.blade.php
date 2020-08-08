<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GS Database</title>
</head>
<body>
    <h3>{{ count($employees) }} employees</h3>
    <ul>
        @foreach ($employees as $employee)
            <li>{{ $employee }}</li>
        @endforeach
    </ul>
    <a href="/purge/employees">Purge the employees table</a><hr>

    <h3>{{ count($customers) }} customers</h3>
    <ul>
        @foreach ($customers as $customer)
            <li>{{ $customer }}</li>
        @endforeach
    </ul>
    <a href="/purge/customers">Purge the customers table</a><hr>

    <h3>{{ count($orders) }} orders</h3>
    <ul>
        @foreach ($orders as $order)
            <li>{{ $order }}</li>
        @endforeach
    </ul>
    <a href="/purge/orders">Purge the orders table</a><hr>

    <h3>{{ count($storages) }} storages</h3>
    <ul>
        @foreach ($storages as $storage)
            <li>{{ $storage }}</li>
        @endforeach
    </ul>
    <a href="/purge/storages">Purge the storages table</a><hr>

    <h3>{{ count($cargoes) }} cargoes</h3>
    <ul>
        @foreach ($cargoes as $cargo)
            <li>{{ $cargo }}</li>
        @endforeach
    </ul>
    <a href="/purge/cargoes">Purge the cargoes table</a>
</body>
</html>