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
            <li>{{ $employee }} [ <a href="delete/employee/{{ $employee->id }}">Delete</a> ]</li>
        @endforeach
    </ul>
    <a href="/purge/employees">Purge the employees table</a><hr>

    <h3>{{ count($customers) }} customers</h3>
    <ul>
        @foreach ($customers as $customer)
            <li>{{ $customer }} [ <a href="delete/customer/{{ $customer->id }}">Delete</a> ]</li>
        @endforeach
    </ul>
    <a href="/purge/customers">Purge the customers table</a><hr>

    <h3>{{ count($orders) }} orders</h3>
    <ul>
        @foreach ($orders as $order)
            <li>{{ $order }} [ <a href="delete/order/{{ $order->id }}">Delete</a> ]</li>
        @endforeach
    </ul>
    <a href="/purge/orders">Purge the orders table</a><hr>

    <h3>{{ count($storages) }} storages</h3>
    <ul>
        @foreach ($storages as $storage)
            <li>{{ $storage }} [ <a href="delete/storage/{{ $storage->id }}">Delete</a> ]</li>
        @endforeach
    </ul>
    <a href="/purge/storages">Purge the storages table</a><hr>

    <h3>{{ count($cargoes) }} cargoes</h3>
    <ul>
        @foreach ($cargoes as $cargo)
            <li>{{ $cargo }} [ <a href="delete/cargo/{{ $cargo->id }}">Delete</a> ]</li>
        @endforeach
    </ul>
    <a href="/purge/cargoes">Purge the cargoes table</a>
</body>
</html>