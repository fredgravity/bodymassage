@extends('admin.layout.base')
@section('title', 'Dashboard')
@section('data-page-id', 'adminDashboard')


@section('content')


    <div class="dashboard admin_shared grid-container full" data-equalizer data-equalizer-on="medium">
        <div class="grid-x grid-padding-x " >

            {{--ORDER SUMMARY--}}
            <div class="small-12 medium-3 cell summary" data-equalizer-watch>

                <div class="card">
                    <div class="card-section">
                        <div class="grid-padding-x grid-x">
                            <div class="small-3 cell">
                                <i class="fa fa-shopping-cart icons" aria-hidden="true"></i>
                            </div>
                            <div class="small-9 cell summary-text">
                                <p>Orders</p> <h4>{{ $orders }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-divider">
                        <div class="grid-x cell summary-divider">
                            <a href="/profile/{{user()->username}}/orders">Order Details</a>
                        </div>
                    </div>
                </div>

            </div>

            {{--STOCK SUMMARY--}}
            <div class="small-12 medium-3 cell summary" data-equalizer-watch >

                <div class="card">
                    <div class="card-section">
                        <div class="grid-x grid-padding-x">
                            <div class="small-3 cell">
                                <i class="fa fa-thermometer-empty icons" aria-hidden="true"></i>
                            </div>
                            <div class="small-9  cell text-right  summary-text">
                                <p>Products</p> <h4>{{ $products }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-divider">
                        <div class="text-right summary-divider cell">
                            <a href="/profile/{{user()->username}}/products">View Products</a>
                        </div>
                    </div>
                </div>

            </div>

            {{--REVENUE SUMMARY--}}
            <div class="small-12 medium-3 cell summary" data-equalizer-watch >

                <div class="card">
                    <div class="card-section">
                        <div class="grid-x grid-padding-x">
                            <div class="small-3 cell">
                                <i class="fa fa-money-bill icons" aria-hidden="true"></i>
                            </div>
                            <div class="small-9  cell text-right  summary-text">
                                <p>Revenue GHS</p> <h4>{{ number_format($payments, 2) }}</h4>

                            </div>
                        </div>
                    </div>

                    <div class="card-divider">
                        <div class="summary-divider text-right  cell">
                            <a href="/profile/{{user()->username}}/payments">Payment Details</a>
                        </div>
                    </div>
                </div>

            </div>

            {{--SIGNUP SUMMARY--}}
            <div class="small-12 medium-3 cell summary" data-equalizer-watch>

                <div class="card">
                    <div class="card-section">
                        <div class="grid-x grid-padding-x">
                            <div class="small-3 cell">
                                <i class="fa fa-user icons" aria-hidden="true"></i>
                            </div>
                            <div class="small-9 cell summary-text">
                                <p>Signups</p> <h4>{{ $users }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-divider">
                        <div class="summary-divider text-right  cell">
                            <a href="/profile/{{user()->username}}/users">Registered Users</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="grid-padding-x grid-x graph">
            <div class="small-12 medium-6 cell monthly-sales">
                <div class="card">

                    <div class="card-section">
                        <h4>Monthly Orders</h4>
                        <canvas id="monthly-order"></canvas>
                    </div>

                </div>
            </div>

            <div class="small-12 medium-6 cell monthly-revenue">
                <div class="card">

                    <div class="card-section">
                        <h4>Monthly Revenue</h4>
                        <canvas id="monthly-revenue"></canvas>
                    </div>

                </div>
            </div>

        </div>


        <div class="grid-x grid-padding-x">
            <div class="small-12 medium-12 cell yearly-sales">
                <div class="card">

                    <div class="card-section">
                        <h4 class="text-center">Yearly Analysis</h4>
                        <canvas id="yearly-orders"></canvas>
                    </div>

                </div>

            </div>

        </div>


        <div class="grid-padding-x grid-x">

            <h5 class="cell text-center">Order History</h5>
            <div class="small-12 medium-12 cell">

                <table class="table-scroll hover " >
                    <thead>
                    <th>Image</th>
                    <th>Massage Type</th>
                    <th>Address</th>

                    <th>Status (payment|work)</th>
                    </thead>

                    <tbody class="overflow-y-scroll" style="height: 50px !important; overflow-y: auto; overflow-x: auto;">
                    @foreach($order_details as $order)
                        <tr>
                            <td><img src="/{{$order->product['image_path']}}" alt="{{$order->product['product_name']}}" style="width: 50px;"></td>
                            <td>{{$order->product['product_name']}}</td>
                            <td>{{$order->place_name}}</td>
                            <td><button class="button warning small" style="margin: 0;">{{$order->status}}</button>
                                <span><button class="button info small" style="margin: 0;">Complete</button></span>
                            </td>


                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>




    </div>







@endsection









