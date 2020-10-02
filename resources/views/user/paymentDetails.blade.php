@extends('layout.profile_base')
@section('title', 'My Payments')
@section('data-page-id', 'myPayments')


@section('content')


    <div class="grid-container fluid product">

        <h2 class="text-center">My Payments - GHS {{ number_format($amount, 2) }}</h2>
        <hr>

        <section>
            {{--<div class="grid-x grid-padding-x">--}}

                {{--<div class="small-12 medium-6 cell">--}}
                    {{--<form action="" method="get" class="input-group">--}}
                        {{--<input type="text" placeholder="SearchController Product" class="input-group-field">--}}
                        {{--<div class="input-group-button">--}}
                            {{--<input type='submit' class="button" value="SearchController">--}}
                        {{--</div>--}}
                        {{--<input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::generate() }}">--}}
                    {{--</form>--}}
                {{--</div>--}}

                {{--<div>--}}
                    {{--<a href="/profile/{{user()->username}}/payments/graph" class="button">Payment Graph</a>--}}
                {{--</div>--}}

            {{--</div>--}}

            {{--@include('includes.messages')--}}

            <div class="grid-x grid-padding-x">

                @if(count($payments))

                        <table class="hover">
                            <thead>
                                <tr>
                                    <td>Order Number</td>
                                    <td>Total Amount</td>
                                    <td>Username</td>
                                    <td>Email</td>
                                    <td>Status</td>
                                    <td>Address</td>
                                    <td>Phone</td>

                                </tr>
                            </thead>

                            @foreach($payments as $payment)
                            <tbody>
                                <tr>
                                    <td>{{$payment['order_number']}}</td>
                                    <td>{{$payment['amount']}}</td>
                                    <td>{{$payment['user']['username']}}</td>
                                    <td>{{$payment['user']['email']}}</td>
                                    <td>{{$payment['status']}}</td>
                                    <td>{{$payment['user']['address']}}</td>
                                    <td>233-{{$payment['user']['phone']}}</td>

                                    {{--<td>{{$order['description']}}</td>--}}
                                    {{--<td><img src="/{{$product['image_path']}}" alt="{{$product['product_name']}}"></td>--}}



                                </tr>

                            </tbody>

                            @endforeach
                        </table>



                @endif

            </div>


        </section>

    </div>



    

    @endsection









