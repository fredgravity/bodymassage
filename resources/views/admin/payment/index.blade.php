@extends('admin.layout.base')
@section('title', 'Payment')


@section('content')


    <div class="grid-container fluid product">

        <h2 class="text-center">
            GHS {{ number_format($revenue, 2) }}
        </h2>
        <hr>

        <section>
            <div class="grid-x grid-padding-x">

                <div class="small-12 medium-6 cell">
                    <form action="/search/payment" method="post" class="input-group">
                        <input type="text" placeholder="Search Product" name="search" class="input-group-field">
                        <div class="input-group-button">
                            <input type='submit' class="button" value="Search">
                        </div>
                        <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::generate() }}">
                    </form>
                </div>

                <div>
                    <a href="/profile/{{user()->username}}/payments/graph" class="button">Payment Graph</a>
                </div>

            </div>

            @include('includes.messages')

            <div class="grid-x grid-padding-x">

                @if(count($payments))

                        <table class="hover">
                            <thead>
                                <tr>
                                    <td>Order Number</td>
                                    <td>Total Amount</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                            </thead>

                            @foreach($payments as $payment)
                            <tbody>
                                <tr>
                                    <td>{{$payment['order_number']}}</td>
                                    <td>{{$payment['amount']}}</td>
                                    <td>{{$payment['status']}}</td>

                                    <td>
                                        <span data-tooltip class="has-tip top" tabindex="1" title="Payment Details" >
                                            <a href='/profile/{{user()->username}}/payments/{{$payment['id']}}/payment_details'><i class="fa fa-arrow-alt-circle-right" title="Payment Details"></i></a>
                                        </span>


                                    </td>

                                </tr>

                            </tbody>

                            @endforeach
                        </table>

                        {{--Pagination--}}
                    @include('includes.paginate_links')


                @endif

            </div>


        </section>

    </div>



    

    @endsection









