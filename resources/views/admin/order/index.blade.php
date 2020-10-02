@extends('admin.layout.base')
@section('title', 'Orders')


@section('content')


    <div class="grid-container fluid product">

        <h2 class="text-center">Orders</h2>
        <hr>

        <section>
            <div class="grid-x grid-padding-x">

                <div class="small-12 medium-6 cell">
                    <form action="/search/order" method="post" class="input-group">
                        <input type="text" placeholder="Search Product" name="search" class="input-group-field">
                        <div class="input-group-button">
                            <input type='submit' class="button" value="Search">
                        </div>
                        <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::generate() }}">
                    </form>
                </div>

            </div>

            @include('includes.messages')

            <div class="grid-x grid-padding-x">

                @if(count($orders))

                        <table class="hover">
                            <thead>
                                <tr>
                                    <td>Order Number</td>
                                    <td>Reference No.</td>
                                    {{--<td>Product Description</td>--}}
                                    {{--<td>Product Image</td>--}}
                                    <td>Action</td>
                                </tr>
                            </thead>

                            @foreach($orders as $order)
                            <tbody>
                                <tr>
                                    <td>{{$order['order_number']}}</td>
                                    <td>{{$order['ref_no']}}</td>
                                    {{--<td>{{$order['description']}}</td>--}}
                                    {{--<td><img src="/{{$product['image_path']}}" alt="{{$product['product_name']}}"></td>--}}

                                    <td>
                                        <span data-tooltip class="has-tip top" tabindex="1" title="Order Details" >
                                            <a href='/profile/{{user()->username}}/orders/{{$order['id']}}/order_details'><i class="fa fa-arrow-alt-circle-right" title="Order Details"></i></a>
                                        </span>

                                                    &nbsp;

                                                    {{--<span data-tooltip class="has-tip top" tabindex="1" title="Edit User" >--}}
                                                    {{--<a href='/admin/user/{{$user['id']}}/delete'><i class="fa fa-trash" title="Edit User"></i></a>--}}
                                                    {{--</span>--}}


                                                    <span data-tooltip class="has-tip top" tabindex="1" title="Delete Order">
                                            <form action='/profile/{{user()->username}}/orders/{{$order['id']}}/delete_order' method="post" class="delete-order">
                                                <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::generate() }}">
                                                <button type="submit"><i class="fa fa-times delete"></i></button>
                                            </form>
                                        </span>
                                    </td>

                                </tr>

                            </tbody>

                            @endforeach
                        </table>
                        @if($links)
                            {!! $links !!}
                            @endif


                @endif

            </div>


        </section>

    </div>



    

    @endsection









