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
                            <div class="small-9 cell">
                                <p>Total Orders</p> <h4>{{ $orders }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-divider">
                        <div class="cell">
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
                            <div class="small-9 cell">
                                <p>Orders Paid</p> <h4>GHS {{ number_format($payments, 2) }}</h4>
                                {{--<p>Orders Paid</p> <h4>{{ $payments }}</h4>--}}
                            </div>
                        </div>
                    </div>

                    <div class="card-divider">
                        <div class="cell">
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
    </div>




@endsection


