@extends('layout')

@section('content')
    <nav class="navbar navbar-expand navbar-dark bg-dark sticky-top">
        <div class="navbar-nav container-fluid justify-content-center">
            <a href="/profile" class="nav-link mx-lg-2 {{ Request::path() == 'profile' ? 'active' : '' }}">Profile</a>
            <a href="/profile/orders" class="nav-link mx-lg-2 {{ Request::path() == 'profile/orders' ? 'active' : '' }}">Orders</a>
            @if (Auth::user()->can('viewEmployees', App\User::class))
                <a href="/profile/employees" class="nav-link mx-lg-2 {{ Request::path() == 'profile/employees' ? 'active' : '' }}">Employees</a>
            @endif
            <a href="/profile/stats" class="nav-link mx-lg-2 {{ Request::path() == 'profile/stats' ? 'active' : '' }}">Stats</a>
            <a href="/profile/settings" class="nav-link mx-lg-2 {{ Request::path() == 'profile/settings' ? 'active' : '' }}">Settings</a>
        </div>
    </nav>

    @yield('profileContent')
@endsection