@extends('layout.app')
@section('title', 'Cart Page')
@section('data-page-id', 'cartPage')


@section('content')

    <section class="cartPage" id="cartPage">
        @include('includes.messages')

        <div style="display: none; font-size: 3rem;" id="load-spinner-cart" class="float-center">
            @include('includes.spinner')
        </div>
        @if($item)
            {{--<h3>{{ $item }}</h3>--}}
            <img src="/images/empty-cart.png" alt="empty_cart" style="width: 100%; height: 500px; ">
        @else
{{--{{ pnd($cart) }}--}}
            @foreach($cart['results'] as $result)
                 {{--{{ pnd($result) }}--}}
                {{--@foreach($results as $result)--}}
                    {{--{{ pnd($result) }}--}}
                <div class="grid-padding-x grid-x" style="margin-top: 1rem;">

                    <div class="small-12 medium-3 cell" style="border-right: black solid 1px;">
                        {{--{{ pnd($result['image']) }}--}}
                        <div style="font-family: Bahnschrift;">
                            <h6>{{ ucfirst($result["product_name"]) }}</h6>
                        </div>
                        <div>
                            <img src="/{{$result['image']}}" alt="" style="width: 100%; min-height: 150px;">
                        </div>


                    </div>

                    <div class="small-12 medium-9 cell" style="background-color: #f8f8f8;">
                        <div>ORD:_________{{$result['orderNumber']}}</div>
                        <div>Date:_________ {{$result['date']}}</div>
                        {{--<div>Name:_____{{ $result['product_name'] }}</div>--}}
                        <div>Hours:_________{{ $result['hours'] }} hr(s)</div>
                        @if($result['session'] ==='first')
                            <div>Session:_______ 8am - 10pm </div>
                            @elseif($result['session'] ==='second')
                            <div>Session:_______ 11pm - 1pm </div>
                            @elseif($result['session'] ==='third')
                            <div>Session:_______ 2pm - 4pm </div>
                        @endif
                        <div>Price:_________GHS {{ $result['unitPrice'] }}</div>
                        <div>Total:_________GHS {{ $result['total'] }}</div>
                        <div>Ref No:________ {{ $result['ref_no'] }}</div>
                        @if($result['place'] === 'home')
                            {{--{{ 'Home Address:_____ '. user()->address}}--}}
                            <div>Place:_________ {{ $result['place'] }}</div>
                            <div>Home Address:__ {{ $result['place_name'] }}</div>
                        @else
                            <div>Place:_________ {{ $result['place'] }}</div>
                            <div>Other Address:__ {{ $result['place_name'] }}</div>
                        @endif
                        <div>District:________ {{ user()->district }}</div>
                        <div class="grid-padding-x grid-x">
                            <div class="small-12 cell">
                                <form action="/bookings/cart/{{ $result['index'] }}/remove_item" method="post">
                                    <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::generate()}}">
                                    <input type="submit" class="button alert small" value="Remove">
                                </form>
                            </div>

                        </div>


                    </div>

                </div>

                {{--@endforeach--}}

            @endforeach

            @if($cart['cartTotal'] > 0)
                <div class="grid-x grid-padding-x">
                    <div class="small-12 medium-3 cell medium-offset-9 float-right">
                        Grand Total: GHS <h4 id="grand-total">{{ $cart['cartTotal'] }}</h4>
                    </div>

                </div>
                <div class="grid-x grid-padding-x">
                    <div class="small-12 medium-3 medium-offset-9 float-right cell">
                        {{--<input type="hidden" name="serial" value="{{ $cart }}" id="payment-val">--}}
                        {{--<form action="/checkout/go_payment" >--}}
                            {{--<input type="submit" class="button warning" value="Proceed to Payment" id="payment-btn">--}}
                        {{--</form>--}}

                        @include('includes.paystack', ['token'=>\App\Classes\CSRFToken::generate()])
                        @include('includes.flutterwave', ['cartRef'=>$result['ref_no'], 'cartTotal'=>$cart['cartTotal'], 'token'=>\App\Classes\CSRFToken::generate() ])


                    </div>
                </div>


            {{--IPAY BUTTON--}}
            <section>
                {{--@include('includes.ipay')--}}
                <button class="button" data-open="card_modal">Card Payment</button>
                @include('forms.cardPayment', ['cartRef'=>$result['ref_no'], 'cartTotal'=>$cart['cartTotal'] ])
            </section>

            @endif

        @endif
    </section>



@endsection