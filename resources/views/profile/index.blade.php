@extends('profile')

@section('profileContent')
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-md">
                <h1>Welcome, {{ auth()->user()->name }}!</h1>
                <p class="text-muted">Use the links above to navigate the interface.</p>    
                <hr class="d-md-none">
            </div>
            <div class="col-md text-md-right">
                <p><b>Tycoon ID: </b>{{ auth()->user()->tycoon_id ? auth()->user()->tycoon_id : 'none' }} (<a href="/profile/settings">Change</a>)</p>
                @if (auth()->user()->employee)
                    <p>Currently <span class="font-weight-bold {{ auth()->user()->active ? 'text-success' : 'text-danger' }}">{{ auth()->user()->active ? 'active' : 'inactive' }}</span></p>
                @endif
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md">
                <h2 class="mb-3">Current orders</h2>
                @if (count($customerOrders) == 0)
                    <h5 class="text-muted">No active orders. <a href="/order">Place one here!</a></h5>
                @endif
                <div class="row">
                    @foreach ($customerOrders as $order)
                        <div class="col-md{{ Auth::user()->employee ? '-12' : '-6' }} d-flex align-items-stretch">
                            <div class="card my-2 mt-md-0 mb-md-4 w-100">
                                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                                    Order {{ $order->id }}
                                    <a href="/profile/orders?id={{ $order->id }}" class="card-link">Details</a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $order->status_with_emoji }}</h5>
                                    <p class="card-text mb-0"><b>{{ $order->amount_formatted }}x</b> {{ $order->product_name }} @ {{ $order->storage->name }}</p>
                                    <p class="card-text mb-0"><b>Price: </b>{{ $order->total_price_dollars }}</p>
                                    <p class="card-text"><b>Grinder: </b>{{ $order->grinder ? $order->grinder->name : 'none' }}</p>
                                    @if ($order->progress > 0)
                                        <div class="container-fluid bg-success p-0 float-left text-center text-nowrap font-weight-bold rounded-sm"
                                        style="width: {{ $order->progress_percentage }}%;">{{ $order->progress_percentage }} %</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @if (Auth::user()->employee)
                <div class="col-md mt-4 mt-md-0">
                    <hr class="d-md-none">
                    <h2 class="mb-3">Working on</h2>
                    @if (count($grinderOrders) == 0)
                        <h5 class="text-muted">No assigned orders. <a href="/profile/orders">Get one here!</a></h5>
                    @endif
                    <div class="row">
                        @foreach ($grinderOrders as $order)
                            <div class="col-md{{ Auth::user()->employee ? '-12' : '-6' }}">
                                <div class="card my-2 mt-md-0 mb-md-4">
                                    <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                                        Order {{ $order->id }}
                                        <a href="/profile/orders?id={{ $order->id }}" class="card-link">Details</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="btn-group float-right">
                                            <button class="btn btn-gs2">
                                                @switch($order->status)
                                                    @case('In Progress')
                                                        Complete
                                                        @break
                                                    @case('Completed')
                                                        Deliver
                                                        @break
                                                @endswitch
                                            </button>
                                            <button class="btn btn-danger">Cancel</button>
                                        </div>
                                        <h5 class="card-title">{{ $order->status_with_emoji }}</h5>
                                        <p class="card-text mb-0"><b>{{ $order->amount_formatted }}x</b> {{ $order->product_name }} @ {{ $order->storage->name }}</p>
                                        <p class="card-text mb-0"><b>Price: </b>{{ $order->total_price_dollars }}</p>
                                        <p class="card-text"><b>Customer: </b>{{ $order->customer->name }}</p>
                                        @if ($order->progress > 0)
                                            <div class="container-fluid bg-success p-0 float-left text-center text-nowrap font-weight-bold rounded-sm"
                                            style="width: {{ $order->progress_percentage }}%;">{{ $order->progress_percentage }} %</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection