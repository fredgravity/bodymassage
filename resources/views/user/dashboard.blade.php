@extends('layout.profile_base')
@section('title', 'User Profile')
@section('data-page-id', 'userDashboard')


@section('content')

    <div class="dashboard admin_shared grid-container full" data-equalizer data-equalizer-on="medium">
        <div class="grid-padding-x grid-x " >

            {{--TOTAL ORDERS SUMMARY--}}
            <div class="small-12 medium-6 cell summary" data-equalizer-watch>

                <div class="card">
                    <div class="card-section">
                        <div class="grid-x grid-padding-x">
                            <div class="small-3 cell">
                                <i class="fa fa-shopping-cart icons" aria-hidden="true"></i>
                            </div>
                            <div class="small-9 cell summary-text">
                                <p>Total Orders</p> <h4>{{ $orders }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-divider">
                        <div class="cell text-right summary-divider">
                            <a href="/profile/{{ user()->username }}/my_orders">Order Details</a>
                        </div>
                    </div>
                </div>

            </div>



            {{--PAID ORDERS--}}
            <div class="small-12 medium-6 cell summary" data-equalizer-watch >

                <div class="card">
                    <div class="card-section">
                        <div class="grid-padding-x grid-x">
                            <div class="small-3 cell">
                                <i class="fa fa-hand-holding-usd icons" aria-hidden="true"></i>
                            </div>
                            <div class="small-9 cell summary-text">
                                <p>Orders Paid</p> <h4>GHS {{ number_format($payments, 2) }}</h4>
                                {{--<p>Orders Paid</p> <h4>{{ $payments }}</h4>--}}
                            </div>
                        </div>
                    </div>

                    <div class="card-divider">
                        <div class="cell text-right summary-divider">
                            <a href="/profile/{{ user()->username }}/my_payments">Payment Details</a>
                        </div>
                    </div>
                </div>

            </div>



        </div>

        <div class="grid-x grid-padding-x  graph">
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
                        <h4>Monthly Payment</h4>
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

                    <th>Status(payment|work)</th>
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





    </div>




@endsection


