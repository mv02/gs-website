@extends('layout')

@section('content')
    <div id="title" class="container-fluid bg-light text-center p-md-5 p-3">
        <img src="img/gs_emoji.png" alt="GS Logo" class="mb-4">
        <h1 class="display-4 title-font">Grinding Satisfaction</h1>
        <p class="lead">Premium cargo delivery</p>
        <hr>
        <a class="btn btn-gs1 btn-lg" href="/order">Order here</a>
    </div>

    <div id="counters" class="container-fluid bg-dark p-sm-3 p-2">
        <div class="container">
            <div class="row">
                <div class="col-sm lead text-center">
                    <span class="text-light font-weight-bold">{{ $employeeCount }}</span>
                    <span class="text-white-50">hard-working grinders</span></div>
                <div class="col-sm lead text-center">
                    <span class="text-light font-weight-bold">{{ $orderCount }}</span>
                    <span class="text-white-50">completed orders</span>
                </div>
                <div class="col-sm lead text-center">
                    <span class="text-light font-weight-bold">{{ $customerCount }}</span>
                    <span class="text-white-50">satisfied customers</span>
                </div>
            </div>
        </div>
    </div>

    <div id="features" class="container py-5">
        <div class="row my-3 align-items-center">
            <div class="col-md-7 text-center text-md-left">
                <h1>Many types of trucking cargo</h1>
                <p class="lead">
                    Sand, fish, gold. Planks, meat, ore.<br>
                    You name it, we've got it.<br>
                    We offer a huge variety of trucking cargo, for affordable prices.
                </p>
                <a class="btn btn-outline-gs2" href="#prices">Check our prices</a>
            </div>
            <div class="col-md-5">
                <img class="img-fluid img-thumbnail my-3 my-md-0" src="https://via.placeholder.com/1920x1080" alt="">
            </div>
        </div>
        <hr>
        <div class="row my-3 align-items-center">
            <div class="col-md-7 text-center text-md-right order-md-2">
                <h1>Pick any storage</h1>
                <p class="lead">
                    No more long transferring.<br>
                    We will deliver directly to your preferred location.<br>
                    Need to supply your faction? We got you too.
                </p>
                <a class="btn btn-outline-gs2" href="#storages">Choose your storage</a>
            </div>
            <div class="col-md-5">
                <img class="img-fluid img-thumbnail my-3 my-md-0" src="https://via.placeholder.com/1920x1080" alt="">
            </div>
        </div>
        <hr>
        <div class="row my-3 align-items-center">
            <div class="col-md-7 text-center text-md-left">
                <h1>Delivery in no time</h1>
                <p class="lead">
                    We are the fastest grinding mini-company in Tycoon.<br>
                    You will never wait longer than a week for your goods.<br>
                    Are you in a rush? Prioritized orders won't take more than 72 hours.<br>
                </p>
                <a class="btn btn-outline-gs2">View current orders</a>
            </div>
            <div class="col-md-5">
                <img class="img-fluid img-thumbnail my-3 my-md-0" src="https://via.placeholder.com/1920x1080" alt="">
            </div>
        </div>
        <hr>
        <div class="row my-3 align-items-center">
            <div class="col-md text-center text-md-right order-md-2">
                <h1>Quickly, safely, easily</h1>
                <p class="lead">
                    Use our Discord server to track your orders with a few clicks.<br>
                    Our employees are carefully chosen from the pool of applicants.<br>
                    Let us take care of your trucking needs.
                </p>
                <a class="btn btn-outline-gs2" href="https://discord.gg/wG9kVdw">Join our Discord</a>
            </div>
            <div class="col-md-5">
                <img class="img-fluid img-thumbnail my-3 my-md-0" src="https://via.placeholder.com/1920x1080" alt="">
            </div>
        </div>
    </div>

    <div id="tables" class="container-fluid bg-dark text-light py-5">
        <div class="container">
            <div class="row">
                <a name="prices"></a>
                <div class="col-md mb-5 mb-md-0">
                    <h2>Prices and limits</h2>
                    <table id="prices" class="table table-sm table-dark">
                        <thead>
                            <th>Item</th>
                            <th>Price each</th>
                            <th>Order limit</th>
                        </thead>
                        <tbody>
                            @foreach ($cargoes as $cargo)
                                <tr>
                                    <td>{{ $cargo->name }}</td>
                                    <td>${{ number_format($cargo->price) }}</td>
                                    <td>{{ number_format($cargo->limit) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="text-white-50">
                        The stated prices are per one piece, not per one kilogram.<br>
                        You are allowed to order an amount only below the corresponding order limit.<br>
                        You can have multiple active orders of the same item, however the amounts combined must stay below the limits.
                    </p>
                    <a href="/rules">Detailed rules</a>
                </div>

                <a name="storages"></a>
                <div class="col-md">
                    <h2>Available storages</h2>
                    <table id="storages" class="table table-sm table-dark">
                        <thead>
                            <th>Storage</th>
                            <th>Fee per item</th>
                        </thead>
                        <tbody>
                            @foreach ($storages as $storage)
                                <tr>
                                    <td>{{ $storage->name }}</td>
                                    <td>${{ number_format($storage->fee) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="text-white-50">
                        Deliveries to faction storages must be arranged individually.<br>
                        We can deliver only to factions which our grinders are members of.<br>
                        These are often the most known and populated factions.
                    </p>
                    <a href="/rules">Detailed rules</a>
                </div>
            </div>
        </div>
    </div>

    <div id="links" class="container text-center pt-5 py-md-5">
        <div class="row">
            <div class="col-md pb-5 pb-md-0">
                <img src="img/gs_emoji.png" height="100" class="mb-3">
                <p class="lead">We are Grinding Satisfaction, the fastest grinding mini-company. Get to know us!</p>
                <a href="/about" class="btn btn-gs2">Learn more</a>
            </div>
            <div class="col-md pb-5 pb-md-0">
                <img src="img/tycoon_logo.png" height="100" class="mb-3">
                <p class="lead">Our home is Transport Tycoon, one of the largest servers and communities in FiveM.</p>
                <a href="http://tycoon.community/" class="btn btn-gs2">Join the fun</a>
            </div>
            <div class="col-md pb-5 pb-md-0">
                <svg width="100" height="100" viewBox="0 0 16 16" class="bi bi-globe mb-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M1.018 7.5h2.49c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5zM2.255 4H4.09a9.266 9.266 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.024 7.024 0 0 0 2.255 4zM8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm-.5 1.077c-.67.204-1.335.82-1.887 1.855-.173.324-.33.682-.468 1.068H7.5V1.077zM7.5 5H4.847a12.5 12.5 0 0 0-.338 2.5H7.5V5zm1 2.5V5h2.653c.187.765.306 1.608.338 2.5H8.5zm-1 1H4.51a12.5 12.5 0 0 0 .337 2.5H7.5V8.5zm1 2.5V8.5h2.99a12.495 12.495 0 0 1-.337 2.5H8.5zm-1 1H5.145c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12zm-2.173 2.472a6.695 6.695 0 0 1-.597-.933A9.267 9.267 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM1.674 11H3.82a13.651 13.651 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5zm8.999 3.472A7.024 7.024 0 0 0 13.745 12h-1.834a9.278 9.278 0 0 1-.641 1.539 6.688 6.688 0 0 1-.597.933zM10.855 12H8.5v2.923c.67-.204 1.335-.82 1.887-1.855A7.98 7.98 0 0 0 10.855 12zm1.325-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm.312-3.5h2.49a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5zM11.91 4a9.277 9.277 0 0 0-.64-1.539 6.692 6.692 0 0 0-.597-.933A7.024 7.024 0 0 1 13.745 4h-1.834zm-1.055 0H8.5V1.077c.67.204 1.335.82 1.887 1.855.173.324.33.682.468 1.068z"/>
                </svg>
                <p class="lead">Check our web interface if you're interested in your order stats and much more info.</p>
                <a href="/login" class="btn btn-gs2">Login with Discord</a>
            </div>
        </div>
    </div>
@endsection