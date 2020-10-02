@extends('admin.layout.base')
@section('title', 'Payment Details')


@section('content')


    <div class="grid-container fluid product">

        <h2 class="text-center">{{$payments['order_number']}}</h2>
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

            @include('includes.messages')

            <div class="grid-x grid-padding-x">
{{--{{ $payments['amount'] }}--}}
                @if($payments)

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

                            {{--@foreach($payments as $payment)--}}
                            <tbody>
                                <tr>
                                    <td>{{$payments['order_number']}}</td>
                                    <td>{{$payments['amount']}}</td>
                                    <td>{{$payments['user']['username']}}</td>
                                    <td>{{$payments['user']['email']}}</td>
                                    <td>{{$payments['status']}}</td>
                                    <td>{{$payments['user']['address']}}</td>
                                    <td>233-{{$payments['user']['phone']}}</td>

                                    {{--<td>{{$order['description']}}</td>--}}
                                    {{--<td><img src="/{{$product['image_path']}}" alt="{{$product['product_name']}}"></td>--}}



                                </tr>

                            </tbody>

                            {{--@endforeach--}}
                        </table>



                @endif

            </div>


        </section>

    </div>



    

    @endsection









